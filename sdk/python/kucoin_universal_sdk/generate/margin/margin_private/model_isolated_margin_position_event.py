# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, Callable, ClassVar, Dict, List, Optional
from .model_isolated_margin_position_change_assets_value import IsolatedMarginPositionChangeAssetsValue
from kucoin_universal_sdk.internal.interfaces.websocket import WebSocketMessageCallback
from kucoin_universal_sdk.model.common import WsMessage


class IsolatedMarginPositionEvent(BaseModel):
    """
    IsolatedMarginPositionEvent

    Attributes:
        tag (str): Isolated margin symbol
        status (StatusEnum): Position status
        status_biz_type (StatusBizTypeEnum): Status type
        accumulated_principal (str): Accumulated principal
        change_assets (dict[str, IsolatedMarginPositionChangeAssetsValue]): 
        timestamp (int): 
    """

    class StatusEnum(Enum):
        """
        Attributes:
            DEBT: Debt
            CLEAR: debt-free
            IN_BORROW: Borrowing
            IN_REPAY: Repayment in progress
            IN_LIQUIDATION: Position closing
            IN_AUTO_RENEW: Automatically renewing
        """
        DEBT = 'DEBT'
        CLEAR = 'CLEAR'
        IN_BORROW = 'IN_BORROW'
        IN_REPAY = 'IN_REPAY'
        IN_LIQUIDATION = 'IN_LIQUIDATION'
        IN_AUTO_RENEW = 'IN_AUTO_RENEW'

    class StatusBizTypeEnum(Enum):
        """
        Attributes:
            FORCE_LIQUIDATION: Liquidation
            USER_BORROW: User borrow
            TRADE_AUTO_BORROW: Trade auto borrow
            USER_REPAY: User reply
            AUTO_REPAY: Auto reply
            DEFAULT_DEBT: In debt
            DEFAULT_CLEAR: No debt
            ONE_CLICK_LIQUIDATION: One click liquidation
            B2_C_INTEREST_SETTLE_LIQUIDATION: B2C interest settle liquidation
            AIR_DROP_LIQUIDATION: Air drop liquidation
        """
        FORCE_LIQUIDATION = 'FORCE_LIQUIDATION'
        USER_BORROW = 'USER_BORROW'
        TRADE_AUTO_BORROW = 'TRADE_AUTO_BORROW'
        USER_REPAY = 'USER_REPAY'
        AUTO_REPAY = 'AUTO_REPAY'
        DEFAULT_DEBT = 'DEFAULT_DEBT'
        DEFAULT_CLEAR = 'DEFAULT_CLEAR'
        ONE_CLICK_LIQUIDATION = 'ONE_CLICK_LIQUIDATION'
        B2_C_INTEREST_SETTLE_LIQUIDATION = 'B2C_INTEREST_SETTLE_LIQUIDATION'
        AIR_DROP_LIQUIDATION = 'AIR_DROP_LIQUIDATION'

    common_response: Optional[WsMessage] = Field(default=None,
                                                 description="Common response")
    tag: Optional[str] = Field(default=None,
                               description="Isolated margin symbol")
    status: Optional[StatusEnum] = Field(default=None,
                                         description="Position status")
    status_biz_type: Optional[StatusBizTypeEnum] = Field(
        default=None, description="Status type", alias="statusBizType")
    accumulated_principal: Optional[str] = Field(
        default=None,
        description="Accumulated principal",
        alias="accumulatedPrincipal")
    change_assets: Optional[Dict[
        str,
        IsolatedMarginPositionChangeAssetsValue]] = Field(default=None,
                                                          alias="changeAssets")
    timestamp: Optional[int] = None

    __properties: ClassVar[List[str]] = [
        "tag", "status", "statusBizType", "accumulatedPrincipal",
        "changeAssets", "timestamp"
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
    def from_json(cls, json_str: str) -> Optional[IsolatedMarginPositionEvent]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        # override the default output from pydantic by calling `to_dict()` of each value in change_assets (dict)
        _field_dict = {}
        if self.change_assets:
            for _key_change_assets in self.change_assets:
                if self.change_assets[_key_change_assets]:
                    _field_dict[_key_change_assets] = self.change_assets[
                        _key_change_assets].to_dict()
            _dict['changeAssets'] = _field_dict
        return _dict

    @classmethod
    def from_dict(
        cls,
        obj: Optional[Dict[str,
                           Any]]) -> Optional[IsolatedMarginPositionEvent]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "tag":
            obj.get("tag"),
            "status":
            obj.get("status"),
            "statusBizType":
            obj.get("statusBizType"),
            "accumulatedPrincipal":
            obj.get("accumulatedPrincipal"),
            "changeAssets":
            dict((_k, IsolatedMarginPositionChangeAssetsValue.from_dict(_v))
                 for _k, _v in obj["changeAssets"].items())
            if obj.get("changeAssets") is not None else None,
            "timestamp":
            obj.get("timestamp")
        })
        return _obj


IsolatedMarginPositionEventCallback = Callable[
    [str, str, IsolatedMarginPositionEvent], None]
"""
args:
    - topic (str) : topic
    - subject (str): subject
    - data (IsolatedMarginPositionEvent): event data
"""


class IsolatedMarginPositionEventCallbackWrapper(WebSocketMessageCallback):

    def __init__(self, cb: IsolatedMarginPositionEventCallback):
        self.callback = cb

    def on_message(self, message: WsMessage):
        event = IsolatedMarginPositionEvent.from_dict(message.raw_data)
        event.common_response = message
        self.callback(message.topic, message.subject, event)
