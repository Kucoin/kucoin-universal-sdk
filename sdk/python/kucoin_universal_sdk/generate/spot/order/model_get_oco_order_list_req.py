# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetOcoOrderListReq(BaseModel):
    """
    GetOcoOrderListReq

    Attributes:
        symbol (str): symbol
        start_at (int): Start time (milliseconds)
        end_at (int): End time (milliseconds)
        order_ids (str): Specify orderId collection, up to 500 orders 
        page_size (int): Size per page, minimum value 10, maximum value 500
        current_page (int): Page number, minimum value 1 
    """

    symbol: Optional[str] = Field(default=None, description="symbol")
    start_at: Optional[int] = Field(default=None,
                                    description="Start time (milliseconds)",
                                    alias="startAt")
    end_at: Optional[int] = Field(default=None,
                                  description="End time (milliseconds)",
                                  alias="endAt")
    order_ids: Optional[str] = Field(
        default=None,
        description="Specify orderId collection, up to 500 orders ",
        alias="orderIds")
    page_size: Optional[int] = Field(
        default=50,
        description="Size per page, minimum value 10, maximum value 500",
        alias="pageSize")
    current_page: Optional[int] = Field(
        default=1,
        description="Page number, minimum value 1 ",
        alias="currentPage")

    __properties: ClassVar[List[str]] = [
        "symbol", "startAt", "endAt", "orderIds", "pageSize", "currentPage"
    ]

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
    def from_json(cls, json_str: str) -> Optional[GetOcoOrderListReq]:
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
                                    Any]]) -> Optional[GetOcoOrderListReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "symbol":
            obj.get("symbol"),
            "startAt":
            obj.get("startAt"),
            "endAt":
            obj.get("endAt"),
            "orderIds":
            obj.get("orderIds"),
            "pageSize":
            obj.get("pageSize") if obj.get("pageSize") is not None else 50,
            "currentPage":
            obj.get("currentPage") if obj.get("currentPage") is not None else 1
        })
        return _obj


class GetOcoOrderListReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_symbol(self, value: str) -> GetOcoOrderListReqBuilder:
        """
        symbol
        """
        self.obj['symbol'] = value
        return self

    def set_start_at(self, value: int) -> GetOcoOrderListReqBuilder:
        """
        Start time (milliseconds)
        """
        self.obj['startAt'] = value
        return self

    def set_end_at(self, value: int) -> GetOcoOrderListReqBuilder:
        """
        End time (milliseconds)
        """
        self.obj['endAt'] = value
        return self

    def set_order_ids(self, value: str) -> GetOcoOrderListReqBuilder:
        """
        Specify orderId collection, up to 500 orders 
        """
        self.obj['orderIds'] = value
        return self

    def set_page_size(self, value: int) -> GetOcoOrderListReqBuilder:
        """
        Size per page, minimum value 10, maximum value 500
        """
        self.obj['pageSize'] = value
        return self

    def set_current_page(self, value: int) -> GetOcoOrderListReqBuilder:
        """
        Page number, minimum value 1 
        """
        self.obj['currentPage'] = value
        return self

    def build(self) -> GetOcoOrderListReq:
        return GetOcoOrderListReq(**self.obj)
