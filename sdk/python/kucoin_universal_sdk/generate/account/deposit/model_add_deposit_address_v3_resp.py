# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional
from kucoin_universal_sdk.internal.interfaces.response import Response
from kucoin_universal_sdk.model.common import RestResponse


class AddDepositAddressV3Resp(BaseModel, Response):
    """
    AddDepositAddressV3Resp

    Attributes:
        address (str): Deposit address
        memo (str): Address remark. If there’s no remark, it is empty. When you withdraw from other platforms to KuCoin, you need to fill in memo(tag). Be careful: If you do not fill in memo(tag), your deposit may not be available.
        chain_id (str): The chainId of currency
        to (str): Deposit account type: MAIN (funding account), TRADE (spot trading account)
        expiration_date (int): Expiration time; Lightning network expiration time; this field is not applicable to non-Lightning networks
        currency (str): currency
        chain_name (str): The chainName of currency
    """

    common_response: Optional[RestResponse] = Field(
        default=None, description="Common response")
    address: Optional[str] = Field(default=None, description="Deposit address")
    memo: Optional[str] = Field(
        default=None,
        description=
        "Address remark. If there’s no remark, it is empty. When you withdraw from other platforms to KuCoin, you need to fill in memo(tag). Be careful: If you do not fill in memo(tag), your deposit may not be available."
    )
    chain_id: Optional[str] = Field(default=None,
                                    description="The chainId of currency",
                                    alias="chainId")
    to: Optional[str] = Field(
        default=None,
        description=
        "Deposit account type: MAIN (funding account), TRADE (spot trading account)"
    )
    expiration_date: Optional[int] = Field(
        default=None,
        description=
        "Expiration time; Lightning network expiration time; this field is not applicable to non-Lightning networks",
        alias="expirationDate")
    currency: Optional[str] = Field(default=None, description="currency")
    chain_name: Optional[str] = Field(default=None,
                                      description="The chainName of currency",
                                      alias="chainName")

    __properties: ClassVar[List[str]] = [
        "address", "memo", "chainId", "to", "expirationDate", "currency",
        "chainName"
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
    def from_json(cls, json_str: str) -> Optional[AddDepositAddressV3Resp]:
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
                               Any]]) -> Optional[AddDepositAddressV3Resp]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "address": obj.get("address"),
            "memo": obj.get("memo"),
            "chainId": obj.get("chainId"),
            "to": obj.get("to"),
            "expirationDate": obj.get("expirationDate"),
            "currency": obj.get("currency"),
            "chainName": obj.get("chainName")
        })
        return _obj

    def set_common_response(self, response: RestResponse):
        self.common_response = response
