import logging
import random
import threading
import time
import urllib.parse
from queue import Queue, Full, Empty
from typing import Dict, List, Optional

import websocket

from kucoin_universal_sdk.model.common import WsMessage
from kucoin_universal_sdk.model.constants import WsMessageType
from kucoin_universal_sdk.model.websocket_option import WebSocketClientOption
from kucoin_universal_sdk.model.websocket_option import WebSocketEvent
from ..interfaces.websocket import WsTokenProvider, WsToken

class WriteMsg:
    def __init__(self, msg: WsMessage, timeout: float):
        self.msg = msg
        self.ts = time.time()
        self.timeout = timeout
        self.exception = None
        self.event = threading.Event()

    def set_exception(self, exception: Exception):
        self.exception = exception
        self.event.set()

class WebSocketClient:
    def __init__(self, token_provider: WsTokenProvider, options: WebSocketClientOption):
        self.options = options
        self.conn = None
        self.conn_lock = threading.Lock()
        self.connected = threading.Event()
        self.shutdown = threading.Event()
        self.disconnect_event = threading.Event()
        self.reconnected_event = threading.Event()
        self.token_provider = token_provider
        self.token_info = None
        self.close_event = threading.Event()
        self.reconnect_close_event = threading.Event()

        self.read_msg = Queue(maxsize=options.read_message_buffer)
        self.write_msg = Queue(maxsize=options.write_message_buffer)

        self.ack_event: Dict[str, WriteMsg] = {}
        self.ack_event_lock = threading.Lock()
        self.metric = {'ping_success': 0, 'ping_err': 0}
        self.keep_alive_thread = None
        self.write_thread = None
        self.ws_thread = None
        self.reconnect_thread = None
        self.welcome_received = threading.Event()

    def start(self):
        with self.conn_lock:
            if self.connected.is_set():
                logging.warning("WebSocket client is already connected.")
                return
            try:
                self.dial()
            except Exception as err:
                logging.error(f"Failed to start WebSocket client: {err}")
                raise
            self.connected.set()
            self.notify_event(WebSocketEvent.EVENT_CONNECTED, "")
            self.run()
            self.reconnect()

    def run(self):
        if not self.keep_alive_thread or not self.keep_alive_thread.is_alive():
            self.keep_alive_thread = threading.Thread(target=self.keep_alive, daemon=True)
            self.keep_alive_thread.start()

        if not self.write_thread or not self.write_thread.is_alive():
            self.write_thread = threading.Thread(target=self.write_message, daemon=True)
            self.write_thread.start()

    def stop(self):
        with self.conn_lock:
            self.notify_event(WebSocketEvent.EVENT_CLIENT_SHUTDOWN, "")
            self.shutdown.set()
            self.close()

    def dial(self):
        try:
            token_infos = self.token_provider.get_token()
            self.token_info = self.random_endpoint(token_infos)
            query_params = {
                "connectId": str(int(time.time() * 1e9)),
                "token": self.token_info.token,
            }
            url_str = f"{self.token_info.endpoint}?{urllib.parse.urlencode(query_params)}"
            self.conn = websocket.WebSocketApp(
                url_str,
                on_message=self.on_message,
                on_error=self.on_error,
                on_close=self.on_close,
                on_open=self.on_open,
            )
            if not self.ws_thread or not self.ws_thread.is_alive():
                self.ws_thread = threading.Thread(target=self.conn.run_forever, daemon=True)
                self.ws_thread.start()
            if not self.welcome_received.wait(timeout=5):
                self.close()
                self.disconnect_event.set()
                raise Exception("Did not receive welcome message")
        except Exception as err:
            self.connected.clear()
            logging.error(f"Failed to connect or validate welcome message: {err}")
            raise

    def on_open(self, ws):
        logging.info("WebSocket connection opened.")

    def on_message(self, ws, message):
        logging.debug(f"Received message: {message}")
        m = WsMessage.from_json(message)
        if m.type == WsMessageType.WELCOME.value:
            self.welcome_received.set()
            logging.info("Welcome message received.")

        elif m.type == WsMessageType.MESSAGE.value:
            self.notify_event(WebSocketEvent.EVENT_MESSAGE_RECEIVED, "")
            try:
                logging.debug(f"queue size: {self.read_msg.qsize()}, max size: {self.read_msg.maxsize}")
                self.read_msg.put(m, block=False)
            except Full:
                self.notify_event(WebSocketEvent.EVENT_READ_BUFFER_FULL, "")
                logging.warning("Read buffer full")

        elif m.type == WsMessageType.PONG.value:
            self.notify_event(WebSocketEvent.EVENT_PONG_RECEIVED, "")
            logging.debug("PONG received")
            self._handle_ack_event(m)

        elif m.type in [WsMessageType.ACK.value, WsMessageType.ERROR.value]:
            self._handle_ack_event(m)

        else:
            logging.warning(f"Unknown message type: {m.type}")

    def _handle_ack_event(self, m: WsMessage):
        with self.ack_event_lock:
            data: WriteMsg = self.ack_event.pop(m.id, None)
            if not data:
                logging.warning(f"Cannot find ack event, id: {m.id}")
                return
            if m.type == WsMessageType.ERROR.value:
                error = m.raw_data
                self.notify_event(WebSocketEvent.EVENT_ERROR_RECEIVED, error)
                data.set_exception(error)
            else:
                data.event.set()

    def read(self):
        return self.read_msg

    def write(self, ms: WsMessage, timeout: float) -> WriteMsg:
        logging.info(f"Write message: {ms}")
        if not self.connected.is_set():
            raise Exception("Not connected")

        msg = WriteMsg(msg=ms, timeout=timeout)
        with self.ack_event_lock:
            self.ack_event[ms.id] = msg
            try:
                self.write_msg.put(msg)
            except Full:
                logging.warning(f"Write buffer is full for message ID {ms.id}.")
                self.ack_event.pop(ms.id, None)
            except Exception as e:
                logging.error(f"Exception in write method: {e}")
                self.ack_event.pop(ms.id, None)
                raise
            finally:
                return msg

    def write_message(self):
        while not self.close_event.is_set():
            try:
                data: WriteMsg = self.write_msg.get(timeout=1)
                if self.conn:
                    self.conn.send(data.msg.to_json())
                    logging.debug(f"Message sent: {data.msg}")
                    data.ts = time.time()
                else:
                    logging.warning("No connection available to send message.")
            except Empty:
                continue
            except Exception as e:
                logging.error(f"Error sending message: {e}")

    def keep_alive(self):
        interval = self.token_info.ping_interval / 1000.0
        timeout = self.token_info.ping_timeout / 1000.0
        last_ping_time = time.time()
        
        while not self.shutdown.is_set() and not self.close_event.is_set():
            current_time = time.time()
            if current_time - last_ping_time >= interval:
                ping_msg = self.new_ping_message()
                try:
                    self.write(ping_msg, timeout=timeout)
                    self.metric['ping_success'] += 1
                except TimeoutError:
                    logging.error("Heartbeat ping timeout")
                    self.metric['ping_err'] += 1
                except Exception as e:
                    logging.error(f"Exception in keep_alive: {e}")
                    self.metric['ping_err'] += 1
                last_ping_time = current_time
            
            time.sleep(1)

    def on_error(self, ws, error):
        logging.error(f"WebSocket error: {error}")
        self.disconnect_event.set()

    def on_close(self, ws, close_status_code, close_msg):
        self.connected.clear()
        self.disconnect_event.set()
        logging.info(f"WebSocket closed with status code {close_status_code}, message: {close_msg}")

    def reconnect(self):
        def reconnect_loop():
            while True:
                if self.reconnect_close_event.wait(timeout=1):
                    return

                if self.disconnect_event.wait(timeout=1):
                    if self.shutdown.is_set():
                        continue

                    logging.info("Broken WebSocket connection, starting reconnection")
                    self.close()
                    self.notify_event(WebSocketEvent.EVENT_TRY_RECONNECT, "")
                    self.disconnect_event.clear()

                    attempt = 0
                    reconnected = False
                    if not self.options.reconnect or (
                        self.options.reconnect_attempts != -1 and attempt >= self.options.reconnect_attempts):
                        logging.error("Max reconnect attempts reached or reconnect disabled")
                        break

                    logging.info(
                        f"Reconnecting in {self.options.reconnect_interval} seconds... (attempt {attempt})")
                    time.sleep(self.options.reconnect_interval)

                    try:
                        self.dial()
                        self.notify_event(WebSocketEvent.EVENT_CONNECTED, "")
                        self.connected.set()
                        self.run()
                        reconnected = True
                        break
                    except Exception as err:
                        logging.error(f"Reconnect attempt {attempt} failed: {err}")
                        attempt += 1

                    if reconnected:
                        self.reconnected_event.set()
                        continue

                    self.notify_event(WebSocketEvent.EVENT_CLIENT_FAIL, "")
                    logging.error("Failed to reconnect after all attempts.")

        self.reconnect_thread = threading.Thread(target=reconnect_loop)
        self.reconnect_thread.start()

    def _clear_message_queues(self):
        while not self.read_msg.empty():
            self.read_msg.get_nowait()
        while not self.write_msg.empty():
            self.write_msg.get_nowait()

    def close(self):
        if self.connected.is_set():
            self.shutdown.set()
            self.disconnect_event.set()
            self.reconnect_close_event.set()
            self.connected.clear()

            with self.ack_event_lock:
                for msg in self.ack_event.values():
                    msg.event.set()
                self.ack_event.clear()
            self._clear_message_queues()

            if self.conn:
                self.conn.close()
                self.conn = None
                self.close_event.set()
                logging.info("WebSocket connection closed.")
        logging.info("Waiting all threads close...")
        self.token_provider.close()
        self.write_thread.join()
        self.keep_alive_thread.join()
        self.ws_thread.join()
        self.reconnect_thread.join()
        self.notify_event(WebSocketEvent.EVENT_DISCONNECTED, "")
        logging.info("WebSocket client closed.")

    def notify_event(self, event: WebSocketEvent, msg: str, msg2=""):
        try:
            if self.options.event_callback is not None:
                self.options.event_callback(event, msg, msg2)
        except Exception as e:
            logging.error(f"Exception in notify_event: {e}")

    def random_endpoint(self, tokens: List[WsToken]) -> Optional[WsToken]:
        if not tokens:
            raise ValueError("Tokens list is empty")
        return random.choice(tokens)

    def new_ping_message(self) -> WsMessage:
        return WsMessage(
            id=str(int(time.time() * 1e9)),
            type=WsMessageType.PING.value,
        )
