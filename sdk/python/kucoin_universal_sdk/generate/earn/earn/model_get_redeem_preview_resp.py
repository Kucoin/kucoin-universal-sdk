# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional
from kucoin_universal_sdk.internal.interfaces.response import Response
from kucoin_universal_sdk.model.common import RestResponse


class GetRedeemPreviewResp(BaseModel, Response):
    """
    GetRedeemPreviewResp

    Attributes:
        currency (str): currency
        redeem_amount (str): Expected redemption amount
        penalty_interest_amount (str): Penalty interest amount, incurred for early redemption of fixed-term products
        redeem_period (int): Redemption waiting period (days)
        deliver_time (int): Expected deliver time (milliseconds)
        manual_redeemable (bool): Whether manual redemption is possible
        redeem_all (bool): Whether the entire holding must be redeemed, required for early redemption of fixed-term products
    """

    common_response: Optional[RestResponse] = Field(
        default=None, description="Common response")
    currency: Optional[str] = Field(default=None, description="currency")
    redeem_amount: Optional[str] = Field(
        default=None,
        description="Expected redemption amount",
        alias="redeemAmount")
    penalty_interest_amount: Optional[str] = Field(
        default=None,
        description=
        "Penalty interest amount, incurred for early redemption of fixed-term products",
        alias="penaltyInterestAmount")
    redeem_period: Optional[int] = Field(
        default=None,
        description="Redemption waiting period (days)",
        alias="redeemPeriod")
    deliver_time: Optional[int] = Field(
        default=None,
        description="Expected deliver time (milliseconds)",
        alias="deliverTime")
    manual_redeemable: Optional[bool] = Field(
        default=None,
        description="Whether manual redemption is possible",
        alias="manualRedeemable")
    redeem_all: Optional[bool] = Field(
        default=None,
        description=
        "Whether the entire holding must be redeemed, required for early redemption of fixed-term products",
        alias="redeemAll")

    __properties: ClassVar[List[str]] = [
        "currency", "redeemAmount", "penaltyInterestAmount", "redeemPeriod",
        "deliverTime", "manualRedeemable", "redeemAll"
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
    def from_json(cls, json_str: str) -> Optional[GetRedeemPreviewResp]:
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
                                    Any]]) -> Optional[GetRedeemPreviewResp]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "currency":
            obj.get("currency"),
            "redeemAmount":
            obj.get("redeemAmount"),
            "penaltyInterestAmount":
            obj.get("penaltyInterestAmount"),
            "redeemPeriod":
            obj.get("redeemPeriod"),
            "deliverTime":
            obj.get("deliverTime"),
            "manualRedeemable":
            obj.get("manualRedeemable"),
            "redeemAll":
            obj.get("redeemAll")
        })
        return _obj

    def set_common_response(self, response: RestResponse):
        self.common_response = response
