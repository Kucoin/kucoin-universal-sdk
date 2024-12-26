import logging
import threading
import uuid
import queue
from typing import List

from kucoin_universal_sdk.model.client_option import ClientOption
from kucoin_universal_sdk.model.common import WsMessage
from kucoin_universal_sdk.model.constants import DomainType
from kucoin_universal_sdk.model.constants import WsMessageType
from kucoin_universal_sdk.model.websocket_option import WebSocketEvent
from ..infra.default_transport import DefaultTransport
from ..infra.default_ws_callback import TopicManager, CallbackManager
from ..infra.default_ws_client import WebSocketClient, WriteMsg
from ..infra.default_ws_token_provider import DefaultWsTokenProvider
from ..interfaces.websocket import WebSocketService, WebSocketMessageCallback
from ..util.sub import SubInfo

class DefaultWsService(WebSocketService):
    def __init__(self, client_option: ClientOption, domain: DomainType, private: bool, sdk_version:str):
        self.token_transport = DefaultTransport(client_option, sdk_version)
        ws_option = client_option.websocket_client_option

        self.client = WebSocketClient(DefaultWsTokenProvider(self.token_transport, domain, private), ws_option)
        self.topic_manager = TopicManager()
        self.option = ws_option
        self.stop_event = threading.Event()
        self.private = private

    def recovery(self):
        def recovery_loop():
            while not self.stop_event.wait(timeout=1):
                event_triggered = self.client.reconnected_event.is_set()
                if self.stop_event.is_set():
                    return
                if event_triggered:
                    logging.info("WebSocket client reconnected, resubscribe...")

                    old_topic_manager = self.topic_manager
                    self.topic_manager = TopicManager()
                    old_topic_manager.range(lambda _, value: self._resubscribe(value))

                    self.client.reconnected_event.clear()
            logging.info("Recovery loop exiting...")

        self.recovery_thread = threading.Thread(target=recovery_loop, daemon=True)
        self.recovery_thread.start()


    def _resubscribe(self, callback_manager: CallbackManager):
        sub_info_list = callback_manager.get_sub_info()
        for sub in sub_info_list:
            try:
                sub_id = self.subscribe(sub['Prefix'], sub['Args'], sub['Callback'])
                self.notify_event(WebSocketEvent.EVENT_RE_SUBSCRIBE_OK, sub_id)
            except Exception as err:
                self.notify_event(WebSocketEvent.EVENT_RE_SUBSCRIBE_ERROR, f"id: {sub.get('SubId', '')}, err: {err}")

    def start(self):
        try:
            self.client.start()
        except Exception as err:
            logging.error(f"Failed to start client: {err}")
            raise
        self.run()
        self.recovery()

    def notify_event(self, event, msg, msg2=""):
        try:
            if self.option.event_callback:
                self.option.event_callback(event, msg, msg2)
        except Exception as e:
            logging.error(f"Exception in notify_event: {e}")

    def run(self):
        def message_loop():
            while not self.stop_event.is_set():
                try:
                    msg: WsMessage = self.client.read().get(timeout=1)
                    if msg is None:
                        break
                    if msg.type != WsMessageType.MESSAGE.value:
                        continue

                    callback_manager = self.topic_manager.get_callback_manager(msg.topic)
                    if callback_manager is None:
                        logging.error(f"Cannot find callback manager, id: {msg.id}, topic: {msg.topic}")
                        continue

                    cb = callback_manager.get(msg.topic)
                    if cb is None:
                        logging.error(f"Cannot find callback for id: {msg.id}, topic: {msg.topic}")
                        continue

                    try:
                        cb.on_message(msg)
                    except Exception as e:
                        logging.error(f"Exception in callback: {e}")
                        self.notify_event(WebSocketEvent.EVENT_CALLBACK_ERROR, str(e))
                except queue.Empty:
                    continue
                except Exception as e:
                    logging.error(f"Error in message loop: {e}")
                    break

        self.message_thread = threading.Thread(target=message_loop, daemon=True)
        self.message_thread.start()

    def stop(self):
        self.stop_event.set()
        logging.info("Closing WebSocket client")
        self.client.stop()
        self.recovery_thread.join()
        self.message_thread.join()

    def subscribe(self, prefix: str, args: List[str], callback: WebSocketMessageCallback) -> str:
        try:
            if args is None:
                args = []
            sub_info = SubInfo(prefix=prefix, args=args, callback=callback)
            sub_id = sub_info.to_id()

            callback_manager = self.topic_manager.get_callback_manager(prefix)
            created = callback_manager.add(sub_info)
            if not created:
                logging.info(f"Already subscribed: {sub_id}")
                raise Exception("Already subscribed")

            sub_event = WsMessage(
                id=sub_id,
                type=WsMessageType.SUBSCRIBE.value,
                topic=sub_info.sub_topic(),
                privateChannel=self.private,
                response=True
            )

            try:
                data: WriteMsg = self.client.write(sub_event, self.option.write_timeout)
                event_triggered = data.event.wait(timeout=data.timeout)
                if event_triggered:
                    logging.info(f"ACK received for message ID {data.msg.id}")
                else:
                    logging.warning(f"Timeout for message ID {data.msg.id}")
                    raise TimeoutError(f"Timeout for message ID {data.msg.id}")
                if data.exception is not None:
                    logging.error(f"ERROR received for message ID {data.msg.id}: {data.exception}")
                return sub_id
            except Exception as err:
                raise
        except Exception as err:
            callback_manager.remove(sub_id)
            logging.error(f"Subscribe error: {sub_id}, error: {err}")
            raise

    def unsubscribe(self, sub_id: str):
        try:
            sub_info = SubInfo.from_id(sub_id)
            callback_manager = self.topic_manager.get_callback_manager(sub_info.prefix)

            sub_event = WsMessage(
                id=str(uuid.uuid4()),
                msg_type=WsMessageType.UNSUBSCRIBE.value,
                topic=sub_info.sub_topic(),
                private_channel=self.private,
                response=True
            )

            try:
                self.client.write(sub_event, self.option.write_timeout)
                callback_manager.remove(sub_id)
                logging.info(f"Unsubscribe success: {sub_id}")
            except Exception as err:
                raise
        except Exception as e:
            logging.error(f"Unsubscribe error: {sub_id}, error: {e}")
            raise
