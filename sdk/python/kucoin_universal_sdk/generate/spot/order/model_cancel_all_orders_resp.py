# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional
from .model_cancel_all_orders_failed_symbols import CancelAllOrdersFailedSymbols
from kucoin_universal_sdk.internal.interfaces.response import Response
from kucoin_universal_sdk.model.common import RestResponse


class CancelAllOrdersResp(BaseModel, Response):
    """
    CancelAllOrdersResp

    Attributes:
        succeed_symbols (list[str]): The Symbols Successfully cancelled
        failed_symbols (list[CancelAllOrdersFailedSymbols]): The Symbols Failed to cancel
    """

    common_response: Optional[RestResponse] = Field(
        default=None, description="Common response")
    succeed_symbols: Optional[List[str]] = Field(
        default=None,
        description="The Symbols Successfully cancelled",
        alias="succeedSymbols")
    failed_symbols: Optional[List[CancelAllOrdersFailedSymbols]] = Field(
        default=None,
        description="The Symbols Failed to cancel",
        alias="failedSymbols")

    __properties: ClassVar[List[str]] = ["succeedSymbols", "failedSymbols"]

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
    def from_json(cls, json_str: str) -> Optional[CancelAllOrdersResp]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        # override the default output from pydantic by calling `to_dict()` of each item in failed_symbols (list)
        _items = []
        if self.failed_symbols:
            for _item_failed_symbols in self.failed_symbols:
                if _item_failed_symbols:
                    _items.append(_item_failed_symbols.to_dict())
            _dict['failedSymbols'] = _items
        return _dict

    @classmethod
    def from_dict(
            cls, obj: Optional[Dict[str,
                                    Any]]) -> Optional[CancelAllOrdersResp]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "succeedSymbols":
            obj.get("succeedSymbols"),
            "failedSymbols": [
                CancelAllOrdersFailedSymbols.from_dict(_item)
                for _item in obj["failedSymbols"]
            ] if obj.get("failedSymbols") is not None else None
        })
        return _obj

    def set_common_response(self, response: RestResponse):
        self.common_response = response
