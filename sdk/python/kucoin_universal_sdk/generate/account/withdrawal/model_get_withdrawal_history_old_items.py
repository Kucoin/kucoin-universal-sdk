# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class GetWithdrawalHistoryOldItems(BaseModel):
    """
    GetWithdrawalHistoryOldItems

    Attributes:
        currency (str): Currency
        create_at (int): Database record creation time
        amount (str): Withdrawal amount
        address (str): Withdrawal address
        wallet_tx_id (str): Wallet Txid
        is_inner (bool): Internal deposit or not
        status (StatusEnum): Status
    """

    class StatusEnum(Enum):
        """
        Attributes:
            PROCESSING: 
            SUCCESS: 
            FAILURE: 
        """
        PROCESSING = 'PROCESSING'
        SUCCESS = 'SUCCESS'
        FAILURE = 'FAILURE'

    currency: Optional[str] = Field(default=None, description="Currency")
    create_at: Optional[int] = Field(
        default=None,
        description="Database record creation time",
        alias="createAt")
    amount: Optional[str] = Field(default=None,
                                  description="Withdrawal amount")
    address: Optional[str] = Field(default=None,
                                   description="Withdrawal address")
    wallet_tx_id: Optional[str] = Field(default=None,
                                        description="Wallet Txid",
                                        alias="walletTxId")
    is_inner: Optional[bool] = Field(default=None,
                                     description="Internal deposit or not",
                                     alias="isInner")
    status: Optional[StatusEnum] = Field(default=None, description="Status")

    __properties: ClassVar[List[str]] = [
        "currency", "createAt", "amount", "address", "walletTxId", "isInner",
        "status"
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
                  json_str: str) -> Optional[GetWithdrawalHistoryOldItems]:
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
                           Any]]) -> Optional[GetWithdrawalHistoryOldItems]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "currency": obj.get("currency"),
            "createAt": obj.get("createAt"),
            "amount": obj.get("amount"),
            "address": obj.get("address"),
            "walletTxId": obj.get("walletTxId"),
            "isInner": obj.get("isInner"),
            "status": obj.get("status")
        })
        return _obj
