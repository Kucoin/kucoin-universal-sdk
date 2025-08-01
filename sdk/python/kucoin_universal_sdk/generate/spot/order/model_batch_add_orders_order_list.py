# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, ClassVar, Dict, List, Optional


class BatchAddOrdersOrderList(BaseModel):
    """
    BatchAddOrdersOrderList

    Attributes:
        client_oid (str): Client Order ID: The ClientOid field is a unique ID created by the user (we recommend using a UUID), and can only contain numbers, letters, underscores (_), and hyphens (-). This field is returned when order information is obtained. You can use clientOid to tag your orders. ClientOid is different from the order ID created by the service provider. Please do not initiate requests using the same clientOid. The maximum length for the ClientOid is 40 characters. 
        symbol (str): symbol
        type (TypeEnum): Specify if the order is a 'limit' order or 'market' order. 
        time_in_force (TimeInForceEnum): [Time in force](https://www.kucoin.com/docs-new/doc-338146) is a special strategy used during trading
        side (SideEnum): Specify if the order is to 'buy' or 'sell'.
        price (str): Specify price for order
        size (str): Specify quantity for order.  When **type** is limited, select one out of two: size or funds. Size refers to the amount of trading targets (the asset name written in front) for the trading pair. The Size must be based on the baseIncrement of the trading pair. The baseIncrement represents the precision for the trading pair. The size of an order must be a positive-integer multiple of baseIncrement and must be between baseMinSize and baseMaxSize.  When **type** is market, select one out of two: size or funds
        stp (StpEnum): [Self Trade Prevention](https://www.kucoin.com/docs-new/doc-338146) is divided into four strategies: CN, CO, CB , and DC
        cancel_after (int): Cancel after n seconds, the order timing strategy is GTT, -1 means it will not be cancelled automatically, the default value is -1 
        post_only (bool): passive order labels, this is disabled when the order timing strategy is IOC or FOK
        hidden (bool): [Hidden order](https://www.kucoin.com/docs-new/doc-338146) or not (not shown in order book)
        iceberg (bool): Whether or not only visible portions of orders are shown in [Iceberg orders](https://www.kucoin.com/docs-new/doc-338146)
        visible_size (str): Maximum visible quantity in iceberg orders
        tags (str): Order tag, length cannot exceed 20 characters (ASCII)
        remark (str): Order placement remarks, length cannot exceed 20 characters (ASCII)
        funds (str): When **type** is market, select one out of two: size or funds
        client_timestamp (int): Equal to KC-API-TIMESTAMP. Needs to be defined if allowMaxTimeWindow is specified.
        allow_max_time_window (int): Order failed after timeout of specified milliseconds, If clientTimestamp + allowMaxTimeWindow < Gateway received the message time, this order will fail.
    """

    class TypeEnum(Enum):
        """
        Attributes:
            LIMIT: 
        """
        LIMIT = 'limit'

    class TimeInForceEnum(Enum):
        """
        Attributes:
            GTC: 
            GTT: 
            IOC: 
            FOK: 
        """
        GTC = 'GTC'
        GTT = 'GTT'
        IOC = 'IOC'
        FOK = 'FOK'

    class SideEnum(Enum):
        """
        Attributes:
            BUY: 
            SELL: 
        """
        BUY = 'buy'
        SELL = 'sell'

    class StpEnum(Enum):
        """
        Attributes:
            DC: 
            CO: 
            CN: 
            CB: 
        """
        DC = 'DC'
        CO = 'CO'
        CN = 'CN'
        CB = 'CB'

    client_oid: Optional[str] = Field(
        default=None,
        description=
        "Client Order ID: The ClientOid field is a unique ID created by the user (we recommend using a UUID), and can only contain numbers, letters, underscores (_), and hyphens (-). This field is returned when order information is obtained. You can use clientOid to tag your orders. ClientOid is different from the order ID created by the service provider. Please do not initiate requests using the same clientOid. The maximum length for the ClientOid is 40 characters. ",
        alias="clientOid")
    symbol: Optional[str] = Field(default=None, description="symbol")
    type: Optional[TypeEnum] = Field(
        default=None,
        description=
        "Specify if the order is a 'limit' order or 'market' order. ")
    time_in_force: Optional[TimeInForceEnum] = Field(
        default=TimeInForceEnum.GTC,
        description=
        "[Time in force](https://www.kucoin.com/docs-new/doc-338146) is a special strategy used during trading",
        alias="timeInForce")
    side: Optional[SideEnum] = Field(
        default=None,
        description="Specify if the order is to 'buy' or 'sell'.")
    price: Optional[str] = Field(default=None,
                                 description="Specify price for order")
    size: Optional[str] = Field(
        default=None,
        description=
        "Specify quantity for order.  When **type** is limited, select one out of two: size or funds. Size refers to the amount of trading targets (the asset name written in front) for the trading pair. The Size must be based on the baseIncrement of the trading pair. The baseIncrement represents the precision for the trading pair. The size of an order must be a positive-integer multiple of baseIncrement and must be between baseMinSize and baseMaxSize.  When **type** is market, select one out of two: size or funds"
    )
    stp: Optional[StpEnum] = Field(
        default=None,
        description=
        "[Self Trade Prevention](https://www.kucoin.com/docs-new/doc-338146) is divided into four strategies: CN, CO, CB , and DC"
    )
    cancel_after: Optional[int] = Field(
        default=-1,
        description=
        "Cancel after n seconds, the order timing strategy is GTT, -1 means it will not be cancelled automatically, the default value is -1 ",
        alias="cancelAfter")
    post_only: Optional[bool] = Field(
        default=False,
        description=
        "passive order labels, this is disabled when the order timing strategy is IOC or FOK",
        alias="postOnly")
    hidden: Optional[bool] = Field(
        default=False,
        description=
        "[Hidden order](https://www.kucoin.com/docs-new/doc-338146) or not (not shown in order book)"
    )
    iceberg: Optional[bool] = Field(
        default=False,
        description=
        "Whether or not only visible portions of orders are shown in [Iceberg orders](https://www.kucoin.com/docs-new/doc-338146)"
    )
    visible_size: Optional[str] = Field(
        default=None,
        description="Maximum visible quantity in iceberg orders",
        alias="visibleSize")
    tags: Optional[str] = Field(
        default=None,
        description="Order tag, length cannot exceed 20 characters (ASCII)")
    remark: Optional[str] = Field(
        default=None,
        description=
        "Order placement remarks, length cannot exceed 20 characters (ASCII)")
    funds: Optional[str] = Field(
        default=None,
        description=
        "When **type** is market, select one out of two: size or funds")
    client_timestamp: Optional[int] = Field(
        default=None,
        description=
        "Equal to KC-API-TIMESTAMP. Needs to be defined if allowMaxTimeWindow is specified.",
        alias="clientTimestamp")
    allow_max_time_window: Optional[int] = Field(
        default=None,
        description=
        "Order failed after timeout of specified milliseconds, If clientTimestamp + allowMaxTimeWindow < Gateway received the message time, this order will fail.",
        alias="allowMaxTimeWindow")

    __properties: ClassVar[List[str]] = [
        "clientOid", "symbol", "type", "timeInForce", "side", "price", "size",
        "stp", "cancelAfter", "postOnly", "hidden", "iceberg", "visibleSize",
        "tags", "remark", "funds", "clientTimestamp", "allowMaxTimeWindow"
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
    def from_json(cls, json_str: str) -> Optional[BatchAddOrdersOrderList]:
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
                               Any]]) -> Optional[BatchAddOrdersOrderList]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "clientOid":
            obj.get("clientOid"),
            "symbol":
            obj.get("symbol"),
            "type":
            obj.get("type"),
            "timeInForce":
            obj.get("timeInForce") if obj.get("timeInForce") is not None else
            BatchAddOrdersOrderList.TimeInForceEnum.GTC,
            "side":
            obj.get("side"),
            "price":
            obj.get("price"),
            "size":
            obj.get("size"),
            "stp":
            obj.get("stp"),
            "cancelAfter":
            obj.get("cancelAfter")
            if obj.get("cancelAfter") is not None else -1,
            "postOnly":
            obj.get("postOnly") if obj.get("postOnly") is not None else False,
            "hidden":
            obj.get("hidden") if obj.get("hidden") is not None else False,
            "iceberg":
            obj.get("iceberg") if obj.get("iceberg") is not None else False,
            "visibleSize":
            obj.get("visibleSize"),
            "tags":
            obj.get("tags"),
            "remark":
            obj.get("remark"),
            "funds":
            obj.get("funds"),
            "clientTimestamp":
            obj.get("clientTimestamp"),
            "allowMaxTimeWindow":
            obj.get("allowMaxTimeWindow")
        })
        return _obj


class BatchAddOrdersOrderListBuilder:

    def __init__(self):
        self.obj = {}

    def set_client_oid(self, value: str) -> BatchAddOrdersOrderListBuilder:
        """
        Client Order ID: The ClientOid field is a unique ID created by the user (we recommend using a UUID), and can only contain numbers, letters, underscores (_), and hyphens (-). This field is returned when order information is obtained. You can use clientOid to tag your orders. ClientOid is different from the order ID created by the service provider. Please do not initiate requests using the same clientOid. The maximum length for the ClientOid is 40 characters. 
        """
        self.obj['clientOid'] = value
        return self

    def set_symbol(self, value: str) -> BatchAddOrdersOrderListBuilder:
        """
        symbol
        """
        self.obj['symbol'] = value
        return self

    def set_type(
        self, value: BatchAddOrdersOrderList.TypeEnum
    ) -> BatchAddOrdersOrderListBuilder:
        """
        Specify if the order is a 'limit' order or 'market' order. 
        """
        self.obj['type'] = value
        return self

    def set_time_in_force(
        self, value: BatchAddOrdersOrderList.TimeInForceEnum
    ) -> BatchAddOrdersOrderListBuilder:
        """
        [Time in force](https://www.kucoin.com/docs-new/doc-338146) is a special strategy used during trading
        """
        self.obj['timeInForce'] = value
        return self

    def set_side(
        self, value: BatchAddOrdersOrderList.SideEnum
    ) -> BatchAddOrdersOrderListBuilder:
        """
        Specify if the order is to 'buy' or 'sell'.
        """
        self.obj['side'] = value
        return self

    def set_price(self, value: str) -> BatchAddOrdersOrderListBuilder:
        """
        Specify price for order
        """
        self.obj['price'] = value
        return self

    def set_size(self, value: str) -> BatchAddOrdersOrderListBuilder:
        """
        Specify quantity for order.  When **type** is limited, select one out of two: size or funds. Size refers to the amount of trading targets (the asset name written in front) for the trading pair. The Size must be based on the baseIncrement of the trading pair. The baseIncrement represents the precision for the trading pair. The size of an order must be a positive-integer multiple of baseIncrement and must be between baseMinSize and baseMaxSize.  When **type** is market, select one out of two: size or funds
        """
        self.obj['size'] = value
        return self

    def set_stp(
        self, value: BatchAddOrdersOrderList.StpEnum
    ) -> BatchAddOrdersOrderListBuilder:
        """
        [Self Trade Prevention](https://www.kucoin.com/docs-new/doc-338146) is divided into four strategies: CN, CO, CB , and DC
        """
        self.obj['stp'] = value
        return self

    def set_cancel_after(self, value: int) -> BatchAddOrdersOrderListBuilder:
        """
        Cancel after n seconds, the order timing strategy is GTT, -1 means it will not be cancelled automatically, the default value is -1 
        """
        self.obj['cancelAfter'] = value
        return self

    def set_post_only(self, value: bool) -> BatchAddOrdersOrderListBuilder:
        """
        passive order labels, this is disabled when the order timing strategy is IOC or FOK
        """
        self.obj['postOnly'] = value
        return self

    def set_hidden(self, value: bool) -> BatchAddOrdersOrderListBuilder:
        """
        [Hidden order](https://www.kucoin.com/docs-new/doc-338146) or not (not shown in order book)
        """
        self.obj['hidden'] = value
        return self

    def set_iceberg(self, value: bool) -> BatchAddOrdersOrderListBuilder:
        """
        Whether or not only visible portions of orders are shown in [Iceberg orders](https://www.kucoin.com/docs-new/doc-338146)
        """
        self.obj['iceberg'] = value
        return self

    def set_visible_size(self, value: str) -> BatchAddOrdersOrderListBuilder:
        """
        Maximum visible quantity in iceberg orders
        """
        self.obj['visibleSize'] = value
        return self

    def set_tags(self, value: str) -> BatchAddOrdersOrderListBuilder:
        """
        Order tag, length cannot exceed 20 characters (ASCII)
        """
        self.obj['tags'] = value
        return self

    def set_remark(self, value: str) -> BatchAddOrdersOrderListBuilder:
        """
        Order placement remarks, length cannot exceed 20 characters (ASCII)
        """
        self.obj['remark'] = value
        return self

    def set_funds(self, value: str) -> BatchAddOrdersOrderListBuilder:
        """
        When **type** is market, select one out of two: size or funds
        """
        self.obj['funds'] = value
        return self

    def set_client_timestamp(self,
                             value: int) -> BatchAddOrdersOrderListBuilder:
        """
        Equal to KC-API-TIMESTAMP. Needs to be defined if allowMaxTimeWindow is specified.
        """
        self.obj['clientTimestamp'] = value
        return self

    def set_allow_max_time_window(
            self, value: int) -> BatchAddOrdersOrderListBuilder:
        """
        Order failed after timeout of specified milliseconds, If clientTimestamp + allowMaxTimeWindow < Gateway received the message time, this order will fail.
        """
        self.obj['allowMaxTimeWindow'] = value
        return self

    def build(self) -> BatchAddOrdersOrderList:
        return BatchAddOrdersOrderList(**self.obj)
