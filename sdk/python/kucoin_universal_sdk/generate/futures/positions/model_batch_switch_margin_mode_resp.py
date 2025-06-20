# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional
from .model_batch_switch_margin_mode_errors import BatchSwitchMarginModeErrors
from kucoin_universal_sdk.internal.interfaces.response import Response
from kucoin_universal_sdk.model.common import RestResponse


class BatchSwitchMarginModeResp(BaseModel, Response):
    """
    BatchSwitchMarginModeResp

    Attributes:
        margin_mode (dict[str, str]): Target Margin Model, Symbols that failed to be modified will also be included
        errors (list[BatchSwitchMarginModeErrors]): Symbol which modification failed
    """

    common_response: Optional[RestResponse] = Field(
        default=None, description="Common response")
    margin_mode: Optional[Dict[str, str]] = Field(
        default=None,
        description=
        "Target Margin Model, Symbols that failed to be modified will also be included",
        alias="marginMode")
    errors: Optional[List[BatchSwitchMarginModeErrors]] = Field(
        default=None, description="Symbol which modification failed")

    __properties: ClassVar[List[str]] = ["marginMode", "errors"]

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
    def from_json(cls, json_str: str) -> Optional[BatchSwitchMarginModeResp]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        # override the default output from pydantic by calling `to_dict()` of each item in errors (list)
        _items = []
        if self.errors:
            for _item_errors in self.errors:
                if _item_errors:
                    _items.append(_item_errors.to_dict())
            _dict['errors'] = _items
        return _dict

    @classmethod
    def from_dict(
            cls,
            obj: Optional[Dict[str,
                               Any]]) -> Optional[BatchSwitchMarginModeResp]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "marginMode":
            obj.get("marginMode"),
            "errors": [
                BatchSwitchMarginModeErrors.from_dict(_item)
                for _item in obj["errors"]
            ] if obj.get("errors") is not None else None
        })
        return _obj

    def set_common_response(self, response: RestResponse):
        self.common_response = response
