# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class BatchSwitchMarginModeReq(BaseModel):
    """
    BatchSwitchMarginModeReq

    Attributes:
        margin_mode (MarginModeEnum): Modified margin model: ISOLATED (isolated), CROSS (cross margin).
        symbols (list[str]): Symbol list of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220) 
    """

    class MarginModeEnum(Enum):
        """
        Attributes:
            ISOLATED: Isolated Margin Mode
            CROSS: Cross Margin MOde
        """
        ISOLATED = 'ISOLATED'
        CROSS = 'CROSS'

    margin_mode: Optional[MarginModeEnum] = Field(
        default=None,
        description=
        "Modified margin model: ISOLATED (isolated), CROSS (cross margin).",
        alias="marginMode")
    symbols: Optional[List[str]] = Field(
        default=None,
        description=
        "Symbol list of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220) "
    )

    __properties: ClassVar[List[str]] = ["marginMode", "symbols"]

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
    def from_json(cls, json_str: str) -> Optional[BatchSwitchMarginModeReq]:
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
                               Any]]) -> Optional[BatchSwitchMarginModeReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "marginMode": obj.get("marginMode"),
            "symbols": obj.get("symbols")
        })
        return _obj


class BatchSwitchMarginModeReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_margin_mode(
        self, value: BatchSwitchMarginModeReq.MarginModeEnum
    ) -> BatchSwitchMarginModeReqBuilder:
        """
        Modified margin model: ISOLATED (isolated), CROSS (cross margin).
        """
        self.obj['marginMode'] = value
        return self

    def set_symbols(self, value: list[str]) -> BatchSwitchMarginModeReqBuilder:
        """
        Symbol list of the contract, Please refer to [Get Symbol endpoint: symbol](https://www.kucoin.com/docs-new/api-3470220) 
        """
        self.obj['symbols'] = value
        return self

    def build(self) -> BatchSwitchMarginModeReq:
        return BatchSwitchMarginModeReq(**self.obj)
