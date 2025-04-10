# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetSpotLedgerReq(BaseModel):
    """
    GetSpotLedgerReq

    Attributes:
        currency (str): Currency (you can choose more than one currency). You can specify a max. of 10 currencies in one go. If not specified, all currencies will be queried by default.
        direction (DirectionEnum): direction: in, out
        biz_type (str): Type: DEPOSIT-deposit, WITHDRAW-withdraw, TRANSFER-transfer, SUB_TRANSFER-sub-account transfer, TRADE_EXCHANGE-trade, MARGIN_EXCHANGE-margin trade, KUCOIN_BONUS-bonus, BROKER_TRANSFER-Broker transfer record
        start_at (int): Start time (milliseconds)
        end_at (int): End time (milliseconds)
        current_page (int): Current request page.
        page_size (int): Number of results per request. Minimum is 10, maximum is 500.
    """

    class DirectionEnum(Enum):
        """
        Attributes:
            IN_: Funds in
            OUT: Funds out
        """
        IN_ = 'in'
        OUT = 'out'

    currency: Optional[str] = Field(
        default=None,
        description=
        "Currency (you can choose more than one currency). You can specify a max. of 10 currencies in one go. If not specified, all currencies will be queried by default."
    )
    direction: Optional[DirectionEnum] = Field(
        default=None, description="direction: in, out")
    biz_type: Optional[str] = Field(
        default=None,
        description=
        "Type: DEPOSIT-deposit, WITHDRAW-withdraw, TRANSFER-transfer, SUB_TRANSFER-sub-account transfer, TRADE_EXCHANGE-trade, MARGIN_EXCHANGE-margin trade, KUCOIN_BONUS-bonus, BROKER_TRANSFER-Broker transfer record",
        alias="bizType")
    start_at: Optional[int] = Field(default=None,
                                    description="Start time (milliseconds)",
                                    alias="startAt")
    end_at: Optional[int] = Field(default=None,
                                  description="End time (milliseconds)",
                                  alias="endAt")
    current_page: Optional[int] = Field(default=1,
                                        description="Current request page.",
                                        alias="currentPage")
    page_size: Optional[int] = Field(
        default=50,
        description=
        "Number of results per request. Minimum is 10, maximum is 500.",
        alias="pageSize")

    __properties: ClassVar[List[str]] = [
        "currency", "direction", "bizType", "startAt", "endAt", "currentPage",
        "pageSize"
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
    def from_json(cls, json_str: str) -> Optional[GetSpotLedgerReq]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        return _dict

    @classmethod
    def from_dict(cls, obj: Optional[Dict[str,
                                          Any]]) -> Optional[GetSpotLedgerReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "currency":
            obj.get("currency"),
            "direction":
            obj.get("direction"),
            "bizType":
            obj.get("bizType"),
            "startAt":
            obj.get("startAt"),
            "endAt":
            obj.get("endAt"),
            "currentPage":
            obj.get("currentPage")
            if obj.get("currentPage") is not None else 1,
            "pageSize":
            obj.get("pageSize") if obj.get("pageSize") is not None else 50
        })
        return _obj


class GetSpotLedgerReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_currency(self, value: str) -> GetSpotLedgerReqBuilder:
        """
        Currency (you can choose more than one currency). You can specify a max. of 10 currencies in one go. If not specified, all currencies will be queried by default.
        """
        self.obj['currency'] = value
        return self

    def set_direction(
            self,
            value: GetSpotLedgerReq.DirectionEnum) -> GetSpotLedgerReqBuilder:
        """
        direction: in, out
        """
        self.obj['direction'] = value
        return self

    def set_biz_type(self, value: str) -> GetSpotLedgerReqBuilder:
        """
        Type: DEPOSIT-deposit, WITHDRAW-withdraw, TRANSFER-transfer, SUB_TRANSFER-sub-account transfer, TRADE_EXCHANGE-trade, MARGIN_EXCHANGE-margin trade, KUCOIN_BONUS-bonus, BROKER_TRANSFER-Broker transfer record
        """
        self.obj['bizType'] = value
        return self

    def set_start_at(self, value: int) -> GetSpotLedgerReqBuilder:
        """
        Start time (milliseconds)
        """
        self.obj['startAt'] = value
        return self

    def set_end_at(self, value: int) -> GetSpotLedgerReqBuilder:
        """
        End time (milliseconds)
        """
        self.obj['endAt'] = value
        return self

    def set_current_page(self, value: int) -> GetSpotLedgerReqBuilder:
        """
        Current request page.
        """
        self.obj['currentPage'] = value
        return self

    def set_page_size(self, value: int) -> GetSpotLedgerReqBuilder:
        """
        Number of results per request. Minimum is 10, maximum is 500.
        """
        self.obj['pageSize'] = value
        return self

    def build(self) -> GetSpotLedgerReq:
        return GetSpotLedgerReq(**self.obj)
