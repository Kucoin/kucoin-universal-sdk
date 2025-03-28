# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetPurchaseOrdersItems(BaseModel):
    """
    GetPurchaseOrdersItems

    Attributes:
        currency (str): Currency
        purchase_order_no (str): Purchase order ID
        purchase_size (str): Total purchase size
        match_size (str): Executed size
        interest_rate (str): Target annualized interest rate
        income_size (str): Redeemed amount
        apply_time (int): Time of purchase
        status (StatusEnum): Status: DONE-completed; PENDING-settling
    """

    class StatusEnum(Enum):
        """
        Attributes:
            DONE: 
            PENDING: 
        """
        DONE = 'DONE'
        PENDING = 'PENDING'

    currency: Optional[str] = Field(default=None, description="Currency")
    purchase_order_no: Optional[str] = Field(default=None,
                                             description="Purchase order ID",
                                             alias="purchaseOrderNo")
    purchase_size: Optional[str] = Field(default=None,
                                         description="Total purchase size",
                                         alias="purchaseSize")
    match_size: Optional[str] = Field(default=None,
                                      description="Executed size",
                                      alias="matchSize")
    interest_rate: Optional[str] = Field(
        default=None,
        description="Target annualized interest rate",
        alias="interestRate")
    income_size: Optional[str] = Field(default=None,
                                       description="Redeemed amount",
                                       alias="incomeSize")
    apply_time: Optional[int] = Field(default=None,
                                      description="Time of purchase",
                                      alias="applyTime")
    status: Optional[StatusEnum] = Field(
        default=None, description="Status: DONE-completed; PENDING-settling")

    __properties: ClassVar[List[str]] = [
        "currency", "purchaseOrderNo", "purchaseSize", "matchSize",
        "interestRate", "incomeSize", "applyTime", "status"
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
    def from_json(cls, json_str: str) -> Optional[GetPurchaseOrdersItems]:
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
                                    Any]]) -> Optional[GetPurchaseOrdersItems]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "currency": obj.get("currency"),
            "purchaseOrderNo": obj.get("purchaseOrderNo"),
            "purchaseSize": obj.get("purchaseSize"),
            "matchSize": obj.get("matchSize"),
            "interestRate": obj.get("interestRate"),
            "incomeSize": obj.get("incomeSize"),
            "applyTime": obj.get("applyTime"),
            "status": obj.get("status")
        })
        return _obj
