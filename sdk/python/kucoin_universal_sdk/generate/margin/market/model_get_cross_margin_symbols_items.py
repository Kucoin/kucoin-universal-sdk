# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetCrossMarginSymbolsItems(BaseModel):
    """
    GetCrossMarginSymbolsItems

    Attributes:
        symbol (str): symbol
        name (str): Symbol name
        enable_trading (bool): Whether trading is enabled: True for enabled; false for disabled
        market (str): Trading market
        base_currency (str): Base currency, e.g. BTC.
        quote_currency (str): Quote currency, e.g. USDT.
        base_increment (str): Quantity increment: The quantity for an order must be a positive integer multiple of this increment. Here, the size refers to the quantity of the base currency for the order. For example, for the ETH-USDT trading pair, if the baseIncrement is 0.0000001, the order quantity can be 1.0000001 but not 1.00000001.
        base_min_size (str): The minimum order quantity required to place an order.
        quote_increment (str): Quote increment: The funds for a market order must be a positive integer multiple of this increment. The funds refer to the quote currency amount. For example, for the ETH-USDT trading pair, if the quoteIncrement is 0.000001, the amount of USDT for the order can be 3000.000001 but not 3000.0000001.
        quote_min_size (str): The minimum order funds required to place a market order.
        base_max_size (str): The maximum order size required to place an order.
        quote_max_size (str): The maximum order funds required to place a market order.
        price_increment (str): Price increment: The price of an order must be a positive integer multiple of this increment. For example, for the ETH-USDT trading pair, if the priceIncrement is 0.01, the order price can be 3000.01 but not 3000.001.  Specifies the min. order price as well as the price increment.This also applies to quote currency.
        fee_currency (str): The currency of charged fees.
        price_limit_rate (str): Threshold for price protection
        min_funds (str): The minimum trading amounts
    """

    symbol: Optional[str] = Field(default=None, description="symbol")
    name: Optional[str] = Field(default=None, description="Symbol name")
    enable_trading: Optional[bool] = Field(
        default=None,
        description=
        "Whether trading is enabled: True for enabled; false for disabled",
        alias="enableTrading")
    market: Optional[str] = Field(default=None, description="Trading market")
    base_currency: Optional[str] = Field(
        default=None,
        description="Base currency, e.g. BTC.",
        alias="baseCurrency")
    quote_currency: Optional[str] = Field(
        default=None,
        description="Quote currency, e.g. USDT.",
        alias="quoteCurrency")
    base_increment: Optional[str] = Field(
        default=None,
        description=
        "Quantity increment: The quantity for an order must be a positive integer multiple of this increment. Here, the size refers to the quantity of the base currency for the order. For example, for the ETH-USDT trading pair, if the baseIncrement is 0.0000001, the order quantity can be 1.0000001 but not 1.00000001.",
        alias="baseIncrement")
    base_min_size: Optional[str] = Field(
        default=None,
        description="The minimum order quantity required to place an order.",
        alias="baseMinSize")
    quote_increment: Optional[str] = Field(
        default=None,
        description=
        "Quote increment: The funds for a market order must be a positive integer multiple of this increment. The funds refer to the quote currency amount. For example, for the ETH-USDT trading pair, if the quoteIncrement is 0.000001, the amount of USDT for the order can be 3000.000001 but not 3000.0000001.",
        alias="quoteIncrement")
    quote_min_size: Optional[str] = Field(
        default=None,
        description="The minimum order funds required to place a market order.",
        alias="quoteMinSize")
    base_max_size: Optional[str] = Field(
        default=None,
        description="The maximum order size required to place an order.",
        alias="baseMaxSize")
    quote_max_size: Optional[str] = Field(
        default=None,
        description="The maximum order funds required to place a market order.",
        alias="quoteMaxSize")
    price_increment: Optional[str] = Field(
        default=None,
        description=
        "Price increment: The price of an order must be a positive integer multiple of this increment. For example, for the ETH-USDT trading pair, if the priceIncrement is 0.01, the order price can be 3000.01 but not 3000.001.  Specifies the min. order price as well as the price increment.This also applies to quote currency.",
        alias="priceIncrement")
    fee_currency: Optional[str] = Field(
        default=None,
        description="The currency of charged fees.",
        alias="feeCurrency")
    price_limit_rate: Optional[str] = Field(
        default=None,
        description="Threshold for price protection",
        alias="priceLimitRate")
    min_funds: Optional[str] = Field(default=None,
                                     description="The minimum trading amounts",
                                     alias="minFunds")

    __properties: ClassVar[List[str]] = [
        "symbol", "name", "enableTrading", "market", "baseCurrency",
        "quoteCurrency", "baseIncrement", "baseMinSize", "quoteIncrement",
        "quoteMinSize", "baseMaxSize", "quoteMaxSize", "priceIncrement",
        "feeCurrency", "priceLimitRate", "minFunds"
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
    def from_json(cls, json_str: str) -> Optional[GetCrossMarginSymbolsItems]:
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
                               Any]]) -> Optional[GetCrossMarginSymbolsItems]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "symbol": obj.get("symbol"),
            "name": obj.get("name"),
            "enableTrading": obj.get("enableTrading"),
            "market": obj.get("market"),
            "baseCurrency": obj.get("baseCurrency"),
            "quoteCurrency": obj.get("quoteCurrency"),
            "baseIncrement": obj.get("baseIncrement"),
            "baseMinSize": obj.get("baseMinSize"),
            "quoteIncrement": obj.get("quoteIncrement"),
            "quoteMinSize": obj.get("quoteMinSize"),
            "baseMaxSize": obj.get("baseMaxSize"),
            "quoteMaxSize": obj.get("quoteMaxSize"),
            "priceIncrement": obj.get("priceIncrement"),
            "feeCurrency": obj.get("feeCurrency"),
            "priceLimitRate": obj.get("priceLimitRate"),
            "minFunds": obj.get("minFunds")
        })
        return _obj
