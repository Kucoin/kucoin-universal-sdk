from threading import Lock, RLock
from typing import Dict, List

from ..interfaces.websocket import WebSocketMessageCallback
from ..util.sub import SubInfo


class Callback:
    def __init__(self, callback: WebSocketMessageCallback, id: str, topic: str):
        self.callback = callback
        self.id = id
        self.topic = topic


class CallbackManager:
    def __init__(self, topic_prefix: str):
        self.id_topic_mapping: Dict[str, Dict[str, bool]] = {}
        self.topic_callback_mapping: Dict[str, Callback] = {}
        self.lock = RLock()
        self.topic_prefix = topic_prefix

    def is_empty(self) -> bool:
        with self.lock:
            return len(self.id_topic_mapping) == 0 and len(self.topic_callback_mapping) == 0

    def get_sub_info(self) -> List[SubInfo]:
        with self.lock:
            sub_info_list = []
            for topics in self.id_topic_mapping.values():
                info = SubInfo(prefix=self.topic_prefix, args=[], callback=None)
                for topic in topics:
                    parts = topic.split(":")
                    if len(parts) == 2 and parts[1] != "all":
                        info.args.append(parts[1])
                    if topic in self.topic_callback_mapping:
                        info.callback = self.topic_callback_mapping[topic].callback
                sub_info_list.append(info)
            return sub_info_list

    def add(self, sub_info: SubInfo) -> bool:
        with self.lock:
            id = sub_info.to_id()

            if id in self.id_topic_mapping:
                return False

            topic_map = {}

            for topic in sub_info.topics():
                if topic in self.topic_callback_mapping:
                    continue

                topic_map[topic] = True
                self.topic_callback_mapping[topic] = Callback(
                    callback=sub_info.callback,
                    id=id,
                    topic=topic
                )

            self.id_topic_mapping[id] = topic_map
            return True

    def remove(self, id: str) -> None:
        with self.lock:
            topic_map = self.id_topic_mapping.get(id)
            if not topic_map:
                return

            del self.id_topic_mapping[id]
            for topic in topic_map:
                self.topic_callback_mapping.pop(topic, None)

    def get(self, topic: str) -> WebSocketMessageCallback:
        with self.lock:
            cb = self.topic_callback_mapping.get(topic)
            if cb:
                return cb.callback


class TopicManager:
    def __init__(self):
        self.topic_prefix = {}
        self.lock = Lock()

    def get_callback_manager(self, topic: str) -> CallbackManager:
        parts = topic.split(':')
        prefix = topic
        if len(parts) == 2 and parts[1] != "all":
            prefix = parts[0]

        with self.lock:
            if prefix not in self.topic_prefix:
                self.topic_prefix[prefix] = CallbackManager(topic)
            return self.topic_prefix[prefix]

    def range(self, func):
        with self.lock:
            for key, value in self.topic_prefix.items():
                if not func(key, value):
                    continue
