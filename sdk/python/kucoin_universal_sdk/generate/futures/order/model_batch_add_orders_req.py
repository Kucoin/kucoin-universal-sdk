# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict
from typing import Any, ClassVar, Dict, List, Optional
from .model_batch_add_orders_item import BatchAddOrdersItem


class BatchAddOrdersReq(BaseModel):
    """
    BatchAddOrdersReq

    Attributes:
        items (list[BatchAddOrdersItem]): 
    """

    items: Optional[List[BatchAddOrdersItem]] = None

    __properties: ClassVar[List[str]] = ["items"]

    model_config = ConfigDict(
        populate_by_name=True,
        validate_assignment=False,
        protected_namespaces=(),
    )

    def to_str(self) -> str:
        return pprint.pformat(self.model_dump(by_alias=True))

    def to_json(self) -> str:
        from enum import Enum

        def custom_encoder(obj):
            if isinstance(obj, Enum):
                return obj.value
            if isinstance(obj, BaseModel):
                return obj.to_dict()
            raise TypeError(
                f"Object of type {type(obj)} is not JSON serializable")

        data = []
        if self.items:
            data = [item.to_dict() for item in self.items]
        return json.dumps(data, default=custom_encoder)

    @classmethod
    def from_json(cls, json_str: str) -> Optional[BatchAddOrdersReq]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        # override the default output from pydantic by calling `to_dict()` of each item in items (list)
        _items = []
        if self.items:
            for _item_items in self.items:
                if _item_items:
                    _items.append(_item_items.to_dict())
            _dict['items'] = _items
        return _dict

    @classmethod
    def from_dict(
            cls, obj: Optional[Dict[str, Any]]) -> Optional[BatchAddOrdersReq]:
        if obj is None:
            return None

        obj = {'items': obj}

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "items":
            [BatchAddOrdersItem.from_dict(_item) for _item in obj["items"]]
            if obj.get("items") is not None else None
        })
        return _obj


class BatchAddOrdersReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_items(self,
                  value: list[BatchAddOrdersItem]) -> BatchAddOrdersReqBuilder:
        self.obj['items'] = value
        return self

    def build(self) -> BatchAddOrdersReq:
        return BatchAddOrdersReq(**self.obj)
