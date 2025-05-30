# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class TransferReq(BaseModel):
    """
    TransferReq

    Attributes:
        currency (str): Currency
        amount (str): Transfer Amount (must be a positive integer in the currency's precision)
        direction (DirectionEnum): Fund transfer direction: OUT (Broker account is transferred to Broker sub-account), IN (Broker sub-account is transferred to Broker account)
        account_type (AccountTypeEnum): Broker account types: MAIN (Funding account), TRADE (Spot trading account)
        special_uid (str): Broker sub-account UID, must be the Broker sub-account created by the current Broker user.
        special_account_type (SpecialAccountTypeEnum): Broker sub-account types: MAIN (Funding account), TRADE (Spot trading account)
        client_oid (str): Client Order ID, the unique identifier created by the client. It is recommended to use UUID. The maximum length is 128 bits.
    """

    class DirectionEnum(Enum):
        """
        Attributes:
            OUT: 
            IN_: 
        """
        OUT = 'OUT'
        IN_ = 'IN'

    class AccountTypeEnum(Enum):
        """
        Attributes:
            MAIN: 
            TRADE: 
        """
        MAIN = 'MAIN'
        TRADE = 'TRADE'

    class SpecialAccountTypeEnum(Enum):
        """
        Attributes:
            MAIN: 
            TRADE: 
        """
        MAIN = 'MAIN'
        TRADE = 'TRADE'

    currency: Optional[str] = Field(default=None, description="Currency")
    amount: Optional[str] = Field(
        default=None,
        description=
        "Transfer Amount (must be a positive integer in the currency's precision)"
    )
    direction: Optional[DirectionEnum] = Field(
        default=None,
        description=
        "Fund transfer direction: OUT (Broker account is transferred to Broker sub-account), IN (Broker sub-account is transferred to Broker account)"
    )
    account_type: Optional[AccountTypeEnum] = Field(
        default=None,
        description=
        "Broker account types: MAIN (Funding account), TRADE (Spot trading account)",
        alias="accountType")
    special_uid: Optional[str] = Field(
        default=None,
        description=
        "Broker sub-account UID, must be the Broker sub-account created by the current Broker user.",
        alias="specialUid")
    special_account_type: Optional[SpecialAccountTypeEnum] = Field(
        default=None,
        description=
        "Broker sub-account types: MAIN (Funding account), TRADE (Spot trading account)",
        alias="specialAccountType")
    client_oid: Optional[str] = Field(
        default=None,
        description=
        "Client Order ID, the unique identifier created by the client. It is recommended to use UUID. The maximum length is 128 bits.",
        alias="clientOid")

    __properties: ClassVar[List[str]] = [
        "currency", "amount", "direction", "accountType", "specialUid",
        "specialAccountType", "clientOid"
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
    def from_json(cls, json_str: str) -> Optional[TransferReq]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        return _dict

    @classmethod
    def from_dict(cls, obj: Optional[Dict[str, Any]]) -> Optional[TransferReq]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "currency":
            obj.get("currency"),
            "amount":
            obj.get("amount"),
            "direction":
            obj.get("direction"),
            "accountType":
            obj.get("accountType"),
            "specialUid":
            obj.get("specialUid"),
            "specialAccountType":
            obj.get("specialAccountType"),
            "clientOid":
            obj.get("clientOid")
        })
        return _obj


class TransferReqBuilder:

    def __init__(self):
        self.obj = {}

    def set_currency(self, value: str) -> TransferReqBuilder:
        """
        Currency
        """
        self.obj['currency'] = value
        return self

    def set_amount(self, value: str) -> TransferReqBuilder:
        """
        Transfer Amount (must be a positive integer in the currency's precision)
        """
        self.obj['amount'] = value
        return self

    def set_direction(self,
                      value: TransferReq.DirectionEnum) -> TransferReqBuilder:
        """
        Fund transfer direction: OUT (Broker account is transferred to Broker sub-account), IN (Broker sub-account is transferred to Broker account)
        """
        self.obj['direction'] = value
        return self

    def set_account_type(
            self, value: TransferReq.AccountTypeEnum) -> TransferReqBuilder:
        """
        Broker account types: MAIN (Funding account), TRADE (Spot trading account)
        """
        self.obj['accountType'] = value
        return self

    def set_special_uid(self, value: str) -> TransferReqBuilder:
        """
        Broker sub-account UID, must be the Broker sub-account created by the current Broker user.
        """
        self.obj['specialUid'] = value
        return self

    def set_special_account_type(
            self,
            value: TransferReq.SpecialAccountTypeEnum) -> TransferReqBuilder:
        """
        Broker sub-account types: MAIN (Funding account), TRADE (Spot trading account)
        """
        self.obj['specialAccountType'] = value
        return self

    def set_client_oid(self, value: str) -> TransferReqBuilder:
        """
        Client Order ID, the unique identifier created by the client. It is recommended to use UUID. The maximum length is 128 bits.
        """
        self.obj['clientOid'] = value
        return self

    def build(self) -> TransferReq:
        return TransferReq(**self.obj)
