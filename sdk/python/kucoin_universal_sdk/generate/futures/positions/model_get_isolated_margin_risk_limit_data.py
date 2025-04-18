# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetIsolatedMarginRiskLimitData(BaseModel):
    """
    GetIsolatedMarginRiskLimitData

    Attributes:
        symbol (str): Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220) 
        level (int): Level 
        max_risk_limit (int): Upper limit USDT (included) 
        min_risk_limit (int): Lower limit USDT 
        max_leverage (int): Max. leverage 
        initial_margin (float): Initial margin rate 
        maintain_margin (float): Maintenance margin rate 
    """

    symbol: Optional[str] = Field(
        default=None,
        description=
        "Symbol of the contract. Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220) "
    )
    level: Optional[int] = Field(default=None, description="Level ")
    max_risk_limit: Optional[int] = Field(
        default=None,
        description="Upper limit USDT (included) ",
        alias="maxRiskLimit")
    min_risk_limit: Optional[int] = Field(default=None,
                                          description="Lower limit USDT ",
                                          alias="minRiskLimit")
    max_leverage: Optional[int] = Field(default=None,
                                        description="Max. leverage ",
                                        alias="maxLeverage")
    initial_margin: Optional[float] = Field(default=None,
                                            description="Initial margin rate ",
                                            alias="initialMargin")
    maintain_margin: Optional[float] = Field(
        default=None,
        description="Maintenance margin rate ",
        alias="maintainMargin")

    __properties: ClassVar[List[str]] = [
        "symbol", "level", "maxRiskLimit", "minRiskLimit", "maxLeverage",
        "initialMargin", "maintainMargin"
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
                  json_str: str) -> Optional[GetIsolatedMarginRiskLimitData]:
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
                           Any]]) -> Optional[GetIsolatedMarginRiskLimitData]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "symbol": obj.get("symbol"),
            "level": obj.get("level"),
            "maxRiskLimit": obj.get("maxRiskLimit"),
            "minRiskLimit": obj.get("minRiskLimit"),
            "maxLeverage": obj.get("maxLeverage"),
            "initialMargin": obj.get("initialMargin"),
            "maintainMargin": obj.get("maintainMargin")
        })
        return _obj
