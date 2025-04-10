# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional
from kucoin_universal_sdk.internal.interfaces.response import Response
from kucoin_universal_sdk.model.common import RestResponse


class AddSubAccountApiResp(BaseModel, Response):
    """
    AddSubAccountApiResp

    Attributes:
        uid (str): Sub-account UID
        label (str): apikey remarks
        api_key (str): apiKey
        secret_key (str): secretKey
        api_version (int): apiVersion
        permissions (list[str]): [Permissions](https://www.kucoin.com/docs-new/doc-338144) group list
        ip_whitelist (list[str]): IP whitelist list
        created_at (int): Creation time, Unix timestamp (milliseconds)
    """

    common_response: Optional[RestResponse] = Field(
        default=None, description="Common response")
    uid: Optional[str] = Field(default=None, description="Sub-account UID")
    label: Optional[str] = Field(default=None, description="apikey remarks")
    api_key: Optional[str] = Field(default=None,
                                   description="apiKey",
                                   alias="apiKey")
    secret_key: Optional[str] = Field(default=None,
                                      description="secretKey",
                                      alias="secretKey")
    api_version: Optional[int] = Field(default=None,
                                       description="apiVersion",
                                       alias="apiVersion")
    permissions: Optional[List[str]] = Field(
        default=None,
        description=
        "[Permissions](https://www.kucoin.com/docs-new/doc-338144) group list")
    ip_whitelist: Optional[List[str]] = Field(default=None,
                                              description="IP whitelist list",
                                              alias="ipWhitelist")
    created_at: Optional[int] = Field(
        default=None,
        description="Creation time, Unix timestamp (milliseconds)",
        alias="createdAt")

    __properties: ClassVar[List[str]] = [
        "uid", "label", "apiKey", "secretKey", "apiVersion", "permissions",
        "ipWhitelist", "createdAt"
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
    def from_json(cls, json_str: str) -> Optional[AddSubAccountApiResp]:
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
                                    Any]]) -> Optional[AddSubAccountApiResp]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "uid": obj.get("uid"),
            "label": obj.get("label"),
            "apiKey": obj.get("apiKey"),
            "secretKey": obj.get("secretKey"),
            "apiVersion": obj.get("apiVersion"),
            "permissions": obj.get("permissions"),
            "ipWhitelist": obj.get("ipWhitelist"),
            "createdAt": obj.get("createdAt")
        })
        return _obj

    def set_common_response(self, response: RestResponse):
        self.common_response = response
