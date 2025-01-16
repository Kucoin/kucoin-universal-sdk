# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class CancelOrderByIdReq(BaseModel):
    """
    CancelOrderByIdReq

    Attributes:
        order_id (str): Order id
    """

    order_id: Optional[str] = Field(default=None,
                                    description="Order id",
                                    alias="orderId")

    __properties: ClassVar[List[str]] = ["orderId"]

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
    def from_json(cls, json_str: str) -> Optional[CancelOrderByIdReq]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        return _dict

    @classmethod
    def from_dict(
            cls, obj: Optional[Dict[str,
                                    Any]]) -> Optional[CancelOrderByIdReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({"orderId": obj.get("orderId")})
        return _obj


class CancelOrderByIdReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_order_id(self, value: str) -> CancelOrderByIdReqBuilder:
        """
        Order id
        """
        self.obj['orderId'] = value
        return self

    def build(self) -> CancelOrderByIdReq:
        return CancelOrderByIdReq(**self.obj)