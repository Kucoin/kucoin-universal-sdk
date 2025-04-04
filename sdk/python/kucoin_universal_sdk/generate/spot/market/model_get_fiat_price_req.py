# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetFiatPriceReq(BaseModel):
    """
    GetFiatPriceReq

    Attributes:
        base (str): Ticker symbol of a base currency, e.g. USD, EUR. Default is USD
        currencies (str): Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies.
    """

    base: Optional[str] = Field(
        default='USD',
        description=
        "Ticker symbol of a base currency, e.g. USD, EUR. Default is USD")
    currencies: Optional[str] = Field(
        default=None,
        description=
        "Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies."
    )

    __properties: ClassVar[List[str]] = ["base", "currencies"]

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
    def from_json(cls, json_str: str) -> Optional[GetFiatPriceReq]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        return _dict

    @classmethod
    def from_dict(cls, obj: Optional[Dict[str,
                                          Any]]) -> Optional[GetFiatPriceReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "base":
            obj.get("base") if obj.get("base") is not None else 'USD',
            "currencies":
            obj.get("currencies")
        })
        return _obj


class GetFiatPriceReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_base(self, value: str) -> GetFiatPriceReqBuilder:
        """
        Ticker symbol of a base currency, e.g. USD, EUR. Default is USD
        """
        self.obj['base'] = value
        return self

    def set_currencies(self, value: str) -> GetFiatPriceReqBuilder:
        """
        Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies.
        """
        self.obj['currencies'] = value
        return self

    def build(self) -> GetFiatPriceReq:
        return GetFiatPriceReq(**self.obj)
