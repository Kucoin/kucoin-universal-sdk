# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class ModifyMarginLeverageReq(BaseModel):
    """
    ModifyMarginLeverageReq

    Attributes:
        symbol (str): Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220) 
        leverage (str): Leverage multiple
    """

    symbol: Optional[str] = Field(
        default=None,
        description=
        "Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220) "
    )
    leverage: Optional[str] = Field(default=None,
                                    description="Leverage multiple")

    __properties: ClassVar[List[str]] = ["symbol", "leverage"]

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
    def from_json(cls, json_str: str) -> Optional[ModifyMarginLeverageReq]:
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
                               Any]]) -> Optional[ModifyMarginLeverageReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "symbol": obj.get("symbol"),
            "leverage": obj.get("leverage")
        })
        return _obj


class ModifyMarginLeverageReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_symbol(self, value: str) -> ModifyMarginLeverageReqBuilder:
        """
        Symbol of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220) 
        """
        self.obj['symbol'] = value
        return self

    def set_leverage(self, value: str) -> ModifyMarginLeverageReqBuilder:
        """
        Leverage multiple
        """
        self.obj['leverage'] = value
        return self

    def build(self) -> ModifyMarginLeverageReq:
        return ModifyMarginLeverageReq(**self.obj)
