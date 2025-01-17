# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, Callable, ClassVar, Dict, List, Optional
from .model_market_snapshot_data import MarketSnapshotData
from kucoin_universal_sdk.internal.interfaces.websocket import WebSocketMessageCallback
from kucoin_universal_sdk.model.common import WsMessage


class MarketSnapshotEvent(BaseModel):
    """
    MarketSnapshotEvent

    Attributes:
        sequence (str): 
        data (MarketSnapshotData): 
    """

    common_response: Optional[WsMessage] = Field(default=None,
                                                 description="Common response")
    sequence: Optional[str] = None
    data: Optional[MarketSnapshotData] = None

    __properties: ClassVar[List[str]] = ["sequence", "data"]

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
    def from_json(cls, json_str: str) -> Optional[MarketSnapshotEvent]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        # override the default output from pydantic by calling `to_dict()` of data
        if self.data:
            _dict['data'] = self.data.to_dict()
        return _dict

    @classmethod
    def from_dict(
            cls, obj: Optional[Dict[str,
                                    Any]]) -> Optional[MarketSnapshotEvent]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "sequence":
            obj.get("sequence"),
            "data":
            MarketSnapshotData.from_dict(obj["data"])
            if obj.get("data") is not None else None
        })
        return _obj


MarketSnapshotEventCallback = Callable[[str, str, MarketSnapshotEvent], None]
"""
args:
    - topic (str) : topic
    - subject (str): subject
    - data (MarketSnapshotEvent): event data
"""


class MarketSnapshotEventCallbackWrapper(WebSocketMessageCallback):

    def __init__(self, cb: MarketSnapshotEventCallback):
        self.callback = cb

    def on_message(self, message: WsMessage):
        event = MarketSnapshotEvent.from_dict(message.raw_data)
        event.common_response = message
        self.callback(message.topic, message.subject, event)
