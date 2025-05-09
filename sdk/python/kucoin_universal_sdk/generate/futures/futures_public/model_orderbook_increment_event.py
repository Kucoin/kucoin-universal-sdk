# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, Callable, ClassVar, Dict, List, Optional
from kucoin_universal_sdk.internal.interfaces.websocket import WebSocketMessageCallback
from kucoin_universal_sdk.model.common import WsMessage


class OrderbookIncrementEvent(BaseModel):
    """
    OrderbookIncrementEvent

    Attributes:
        sequence (int): 
        change (str): 
        timestamp (int): 
    """

    common_response: Optional[WsMessage] = Field(default=None,
                                                 description="Common response")
    sequence: Optional[int] = None
    change: Optional[str] = None
    timestamp: Optional[int] = None

    __properties: ClassVar[List[str]] = ["sequence", "change", "timestamp"]

    model_config = ConfigDict(
        populate_by_name=True,
        validate_assignment=False,
        protected_namespaces=(),
    )

    def to_str(self) -> str:
        return pprint.pformat(self.model_dump(by_alias=True))

    def to_json(self) -> str:
        return self.model_dump_json(by_alias=True, exclude_none=True)

    @classmethod
    def from_json(cls, json_str: str) -> Optional[OrderbookIncrementEvent]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        return _dict

    @classmethod
    def from_dict(
            cls,
            obj: Optional[Dict[str,
                               Any]]) -> Optional[OrderbookIncrementEvent]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "sequence": obj.get("sequence"),
            "change": obj.get("change"),
            "timestamp": obj.get("timestamp")
        })
        return _obj


OrderbookIncrementEventCallback = Callable[[str, str, OrderbookIncrementEvent],
                                           None]
"""
args:
    - topic (str) : topic
    - subject (str): subject
    - data (OrderbookIncrementEvent): event data
"""


class OrderbookIncrementEventCallbackWrapper(WebSocketMessageCallback):

    def __init__(self, cb: OrderbookIncrementEventCallback):
        self.callback = cb

    def on_message(self, message: WsMessage):
        event = OrderbookIncrementEvent.from_dict(message.raw_data)
        event.common_response = message
        self.callback(message.topic, message.subject, event)
