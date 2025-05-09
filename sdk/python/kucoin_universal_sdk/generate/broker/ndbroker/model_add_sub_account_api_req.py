# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class AddSubAccountApiReq(BaseModel):
    """
    AddSubAccountApiReq

    Attributes:
        uid (str): Sub-account UID
        passphrase (str): API passphrase
        ip_whitelist (list[str]): IP whitelist list, supports up to 20 IPs
        permissions (list[PermissionsEnum]): Permission group list (only General, Spot and Futures permissions can be set, such as \"General, Trade\"). 
        label (str): apikey remarks (length 4~32) 
    """

    class PermissionsEnum(Enum):
        """
        Attributes:
            GENERAL: 
            SPOT: 
            FUTURES: 
        """
        GENERAL = 'general'
        SPOT = 'spot'
        FUTURES = 'futures'

    uid: Optional[str] = Field(default=None, description="Sub-account UID")
    passphrase: Optional[str] = Field(default=None,
                                      description="API passphrase")
    ip_whitelist: Optional[List[str]] = Field(
        default=None,
        description="IP whitelist list, supports up to 20 IPs",
        alias="ipWhitelist")
    permissions: Optional[List[PermissionsEnum]] = Field(
        default=None,
        description=
        "Permission group list (only General, Spot and Futures permissions can be set, such as \"General, Trade\"). "
    )
    label: Optional[str] = Field(default=None,
                                 description="apikey remarks (length 4~32) ")

    __properties: ClassVar[List[str]] = [
        "uid", "passphrase", "ipWhitelist", "permissions", "label"
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
    def from_json(cls, json_str: str) -> Optional[AddSubAccountApiReq]:
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
                                    Any]]) -> Optional[AddSubAccountApiReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "uid": obj.get("uid"),
            "passphrase": obj.get("passphrase"),
            "ipWhitelist": obj.get("ipWhitelist"),
            "permissions": obj.get("permissions"),
            "label": obj.get("label")
        })
        return _obj


class AddSubAccountApiReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_uid(self, value: str) -> AddSubAccountApiReqBuilder:
        """
        Sub-account UID
        """
        self.obj['uid'] = value
        return self

    def set_passphrase(self, value: str) -> AddSubAccountApiReqBuilder:
        """
        API passphrase
        """
        self.obj['passphrase'] = value
        return self

    def set_ip_whitelist(self, value: list[str]) -> AddSubAccountApiReqBuilder:
        """
        IP whitelist list, supports up to 20 IPs
        """
        self.obj['ipWhitelist'] = value
        return self

    def set_permissions(
        self, value: list[AddSubAccountApiReq.PermissionsEnum]
    ) -> AddSubAccountApiReqBuilder:
        """
        Permission group list (only General, Spot and Futures permissions can be set, such as \"General, Trade\"). 
        """
        self.obj['permissions'] = value
        return self

    def set_label(self, value: str) -> AddSubAccountApiReqBuilder:
        """
        apikey remarks (length 4~32) 
        """
        self.obj['label'] = value
        return self

    def build(self) -> AddSubAccountApiReq:
        return AddSubAccountApiReq(**self.obj)
