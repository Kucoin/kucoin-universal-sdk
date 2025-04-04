# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional
from .model_get_isolated_margin_account_list_v1_assets import GetIsolatedMarginAccountListV1Assets
from kucoin_universal_sdk.internal.interfaces.response import Response
from kucoin_universal_sdk.model.common import RestResponse


class GetIsolatedMarginAccountListV1Resp(BaseModel, Response):
    """
    GetIsolatedMarginAccountListV1Resp

    Attributes:
        total_conversion_balance (str): The total balance of the isolated margin account (in the request coin)
        liability_conversion_balance (str): Total liabilities of the isolated margin account (in the request coin)
        assets (list[GetIsolatedMarginAccountListV1Assets]): Account list
    """

    common_response: Optional[RestResponse] = Field(
        default=None, description="Common response")
    total_conversion_balance: Optional[str] = Field(
        default=None,
        description=
        "The total balance of the isolated margin account (in the request coin)",
        alias="totalConversionBalance")
    liability_conversion_balance: Optional[str] = Field(
        default=None,
        description=
        "Total liabilities of the isolated margin account (in the request coin)",
        alias="liabilityConversionBalance")
    assets: Optional[List[GetIsolatedMarginAccountListV1Assets]] = Field(
        default=None, description="Account list")

    __properties: ClassVar[List[str]] = [
        "totalConversionBalance", "liabilityConversionBalance", "assets"
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
    def from_json(
            cls,
            json_str: str) -> Optional[GetIsolatedMarginAccountListV1Resp]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        # override the default output from pydantic by calling `to_dict()` of each item in assets (list)
        _items = []
        if self.assets:
            for _item_assets in self.assets:
                if _item_assets:
                    _items.append(_item_assets.to_dict())
            _dict['assets'] = _items
        return _dict

    @classmethod
    def from_dict(
        cls, obj: Optional[Dict[str, Any]]
    ) -> Optional[GetIsolatedMarginAccountListV1Resp]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "totalConversionBalance":
            obj.get("totalConversionBalance"),
            "liabilityConversionBalance":
            obj.get("liabilityConversionBalance"),
            "assets": [
                GetIsolatedMarginAccountListV1Assets.from_dict(_item)
                for _item in obj["assets"]
            ] if obj.get("assets") is not None else None
        })
        return _obj

    def set_common_response(self, response: RestResponse):
        self.common_response = response
