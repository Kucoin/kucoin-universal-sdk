# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetTransferQuotasReq(BaseModel):
    """
    GetTransferQuotasReq

    Attributes:
        currency (str): currency
        type (TypeEnum): The account type:MAIN, TRADE, MARGIN, ISOLATED, MARGIN_V2, ISOLATED_V2
        tag (str): Trading pair required when the account type is ISOLATED; other types do not pass, e.g.: BTC-USDT
    """

    class TypeEnum(Enum):
        """
        Attributes:
            MAIN: Funding account
            TRADE: Spot account
            MARGIN: Spot cross margin account
            ISOLATED: Spot isolated margin account
            OPTION: Option account
            MARGIN_V2: Spot cross margin HF account
            ISOLATED_V2: Spot isolated margin HF account
        """
        MAIN = 'MAIN'
        TRADE = 'TRADE'
        MARGIN = 'MARGIN'
        ISOLATED = 'ISOLATED'
        OPTION = 'OPTION'
        MARGIN_V2 = 'MARGIN_V2'
        ISOLATED_V2 = 'ISOLATED_V2'

    currency: Optional[str] = Field(default=None, description="currency")
    type: Optional[TypeEnum] = Field(
        default=None,
        description=
        "The account type:MAIN, TRADE, MARGIN, ISOLATED, MARGIN_V2, ISOLATED_V2"
    )
    tag: Optional[str] = Field(
        default='BTC-USDT',
        description=
        "Trading pair required when the account type is ISOLATED; other types do not pass, e.g.: BTC-USDT"
    )

    __properties: ClassVar[List[str]] = ["currency", "type", "tag"]

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
    def from_json(cls, json_str: str) -> Optional[GetTransferQuotasReq]:
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
                                    Any]]) -> Optional[GetTransferQuotasReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "currency":
            obj.get("currency"),
            "type":
            obj.get("type"),
            "tag":
            obj.get("tag") if obj.get("tag") is not None else 'BTC-USDT'
        })
        return _obj


class GetTransferQuotasReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_currency(self, value: str) -> GetTransferQuotasReqBuilder:
        """
        currency
        """
        self.obj['currency'] = value
        return self

    def set_type(
            self, value: GetTransferQuotasReq.TypeEnum
    ) -> GetTransferQuotasReqBuilder:
        """
        The account type:MAIN, TRADE, MARGIN, ISOLATED, MARGIN_V2, ISOLATED_V2
        """
        self.obj['type'] = value
        return self

    def set_tag(self, value: str) -> GetTransferQuotasReqBuilder:
        """
        Trading pair required when the account type is ISOLATED; other types do not pass, e.g.: BTC-USDT
        """
        self.obj['tag'] = value
        return self

    def build(self) -> GetTransferQuotasReq:
        return GetTransferQuotasReq(**self.obj)
