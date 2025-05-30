# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetIsolatedMarginSymbolsData(BaseModel):
    """
    GetIsolatedMarginSymbolsData

    Attributes:
        symbol (str): symbol
        symbol_name (str): Symbol name
        base_currency (str): Base currency, e.g. BTC.
        quote_currency (str): Quote currency, e.g. USDT.
        max_leverage (int): Max. leverage of this symbol
        fl_debt_ratio (str): 
        trade_enable (bool): 
        auto_renew_max_debt_ratio (str): 
        base_borrow_enable (bool): 
        quote_borrow_enable (bool): 
        base_transfer_in_enable (bool): 
        quote_transfer_in_enable (bool): 
        base_borrow_coefficient (str): 
        quote_borrow_coefficient (str): 
    """

    symbol: Optional[str] = Field(default=None, description="symbol")
    symbol_name: Optional[str] = Field(default=None,
                                       description="Symbol name",
                                       alias="symbolName")
    base_currency: Optional[str] = Field(
        default=None,
        description="Base currency, e.g. BTC.",
        alias="baseCurrency")
    quote_currency: Optional[str] = Field(
        default=None,
        description="Quote currency, e.g. USDT.",
        alias="quoteCurrency")
    max_leverage: Optional[int] = Field(
        default=None,
        description="Max. leverage of this symbol",
        alias="maxLeverage")
    fl_debt_ratio: Optional[str] = Field(default=None, alias="flDebtRatio")
    trade_enable: Optional[bool] = Field(default=None, alias="tradeEnable")
    auto_renew_max_debt_ratio: Optional[str] = Field(
        default=None, alias="autoRenewMaxDebtRatio")
    base_borrow_enable: Optional[bool] = Field(default=None,
                                               alias="baseBorrowEnable")
    quote_borrow_enable: Optional[bool] = Field(default=None,
                                                alias="quoteBorrowEnable")
    base_transfer_in_enable: Optional[bool] = Field(
        default=None, alias="baseTransferInEnable")
    quote_transfer_in_enable: Optional[bool] = Field(
        default=None, alias="quoteTransferInEnable")
    base_borrow_coefficient: Optional[str] = Field(
        default=None, alias="baseBorrowCoefficient")
    quote_borrow_coefficient: Optional[str] = Field(
        default=None, alias="quoteBorrowCoefficient")

    __properties: ClassVar[List[str]] = [
        "symbol", "symbolName", "baseCurrency", "quoteCurrency", "maxLeverage",
        "flDebtRatio", "tradeEnable", "autoRenewMaxDebtRatio",
        "baseBorrowEnable", "quoteBorrowEnable", "baseTransferInEnable",
        "quoteTransferInEnable", "baseBorrowCoefficient",
        "quoteBorrowCoefficient"
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
    def from_json(cls,
                  json_str: str) -> Optional[GetIsolatedMarginSymbolsData]:
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
                           Any]]) -> Optional[GetIsolatedMarginSymbolsData]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "symbol":
            obj.get("symbol"),
            "symbolName":
            obj.get("symbolName"),
            "baseCurrency":
            obj.get("baseCurrency"),
            "quoteCurrency":
            obj.get("quoteCurrency"),
            "maxLeverage":
            obj.get("maxLeverage"),
            "flDebtRatio":
            obj.get("flDebtRatio"),
            "tradeEnable":
            obj.get("tradeEnable"),
            "autoRenewMaxDebtRatio":
            obj.get("autoRenewMaxDebtRatio"),
            "baseBorrowEnable":
            obj.get("baseBorrowEnable"),
            "quoteBorrowEnable":
            obj.get("quoteBorrowEnable"),
            "baseTransferInEnable":
            obj.get("baseTransferInEnable"),
            "quoteTransferInEnable":
            obj.get("quoteTransferInEnable"),
            "baseBorrowCoefficient":
            obj.get("baseBorrowCoefficient"),
            "quoteBorrowCoefficient":
            obj.get("quoteBorrowCoefficient")
        })
        return _obj
