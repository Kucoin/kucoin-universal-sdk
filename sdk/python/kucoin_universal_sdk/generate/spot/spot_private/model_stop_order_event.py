# coding: utf-8

# Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

from __future__ import annotations
import pprint
import json

from enum import Enum
from pydantic import BaseModel, ConfigDict, Field
from typing import Any, Callable, ClassVar, Dict, List, Optional
from kucoin_universal_sdk.internal.interfaces.websocket import WebSocketMessageCallback
from kucoin_universal_sdk.model.common import WsMessage


class StopOrderEvent(BaseModel):
    """
    StopOrderEvent

    Attributes:
        created_at (int): Order created time (milliseconds)
        order_id (str): The unique order id generated by the trading system
        order_price (str): Price
        order_type (OrderTypeEnum): User-specified order type
        side (SideEnum): buy or sell
        size (str): User-specified order size
        stop (StopEnum): Order type
        stop_price (str): Stop Price
        symbol (str): symbol
        trade_type (TradeTypeEnum): The type of trading: TRADE (Spot), MARGIN_TRADE (Cross Margin), MARGIN_ISOLATED_TRADE (Isolated Margin).
        ts (int): Push time (nanoseconds)
        type (TypeEnum): Order Type
    """

    class OrderTypeEnum(Enum):
        """
        Attributes:
            STOP: stop
        """
        STOP = 'stop'

    class SideEnum(Enum):
        """
        Attributes:
            BUY: buy
            SELL: sell
        """
        BUY = 'buy'
        SELL = 'sell'

    class StopEnum(Enum):
        """
        Attributes:
            LOSS: stop loss order
            ENTRY: Take profit order
            L_L_O: Limit stop loss OCO order
            L_S_O: Trigger stop loss OCO order
            E_L_O: Limit stop profit OCO order
            E_S_O: Trigger stop profit OCO order
            TSO: Moving stop loss order
        """
        LOSS = 'loss'
        ENTRY = 'entry'
        L_L_O = 'l_l_o'
        L_S_O = 'l_s_o'
        E_L_O = 'e_l_o'
        E_S_O = 'e_s_o'
        TSO = 'tso'

    class TradeTypeEnum(Enum):
        """
        Attributes:
            TRADE: Spot
            MARGIN_TRADE: Spot margin trade
            MARGIN_ISOLATED_TRADE: Spot margin isolated trade
        """
        TRADE = 'TRADE'
        MARGIN_TRADE = 'MARGIN_TRADE'
        MARGIN_ISOLATED_TRADE = 'MARGIN_ISOLATED_TRADE'

    class TypeEnum(Enum):
        """
        Attributes:
            OPEN: The order is in the order book (maker order)
            MATCH: The message sent when the order is matched, 1. When the status is open and the type is match, it is a maker match.  2. When the status is match and the type is match, it is a taker match.
            UPDATE: The message sent due to the order being modified: STP triggering, partial cancellation of the order. Includes these three scenarios:  1. When the status is open and the type is update: partial amounts of the order have been canceled, or STP triggers  2. When the status is match and the type is update: STP triggers  3. When the status is done and the type is update: partial amounts of the order have been filled and the unfilled part got canceled, or STP is triggered.
            FILLED: The message sent when the status of the order changes to DONE after the transaction
            CANCEL: The message sent when the status of the order changes to DONE due to being canceled
            RECEIVED: The message sent when the order enters the matching system. When the order has just entered the matching system and has not yet done matching logic with the counterparty, a private message with the message type &quot;received&quot; and the order status &quot;new&quot; will be pushed.
        """
        OPEN = 'open'
        MATCH = 'match'
        UPDATE = 'update'
        FILLED = 'filled'
        CANCEL = 'cancel'
        RECEIVED = 'received'

    common_response: Optional[WsMessage] = Field(default=None,
                                                 description="Common response")
    created_at: Optional[int] = Field(
        default=None,
        description="Order created time (milliseconds)",
        alias="createdAt")
    order_id: Optional[str] = Field(
        default=None,
        description="The unique order id generated by the trading system",
        alias="orderId")
    order_price: Optional[str] = Field(default=None,
                                       description="Price",
                                       alias="orderPrice")
    order_type: Optional[OrderTypeEnum] = Field(
        default=None,
        description="User-specified order type",
        alias="orderType")
    side: Optional[SideEnum] = Field(default=None, description="buy or sell")
    size: Optional[str] = Field(default=None,
                                description="User-specified order size")
    stop: Optional[StopEnum] = Field(default=None, description="Order type")
    stop_price: Optional[str] = Field(default=None,
                                      description="Stop Price",
                                      alias="stopPrice")
    symbol: Optional[str] = Field(default=None, description="symbol")
    trade_type: Optional[TradeTypeEnum] = Field(
        default=None,
        description=
        "The type of trading: TRADE (Spot), MARGIN_TRADE (Cross Margin), MARGIN_ISOLATED_TRADE (Isolated Margin).",
        alias="tradeType")
    ts: Optional[int] = Field(default=None,
                              description="Push time (nanoseconds)")
    type: Optional[TypeEnum] = Field(default=None, description="Order Type")

    __properties: ClassVar[List[str]] = [
        "createdAt", "orderId", "orderPrice", "orderType", "side", "size",
        "stop", "stopPrice", "symbol", "tradeType", "ts", "type"
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
    def from_json(cls, json_str: str) -> Optional[StopOrderEvent]:
        return cls.from_dict(json.loads(json_str))

    def to_dict(self) -> Dict[str, Any]:
        _dict = self.model_dump(
            by_alias=True,
            exclude_none=True,
        )
        return _dict

    @classmethod
    def from_dict(cls, obj: Optional[Dict[str,
                                          Any]]) -> Optional[StopOrderEvent]:
        if obj is None:
            return None

        if not isinstance(obj, dict):
            return cls.model_validate(obj)

        _obj = cls.model_validate({
            "createdAt": obj.get("createdAt"),
            "orderId": obj.get("orderId"),
            "orderPrice": obj.get("orderPrice"),
            "orderType": obj.get("orderType"),
            "side": obj.get("side"),
            "size": obj.get("size"),
            "stop": obj.get("stop"),
            "stopPrice": obj.get("stopPrice"),
            "symbol": obj.get("symbol"),
            "tradeType": obj.get("tradeType"),
            "ts": obj.get("ts"),
            "type": obj.get("type")
        })
        return _obj


StopOrderEventCallback = Callable[[str, str, StopOrderEvent], None]
"""
args:
    - topic (str) : topic
    - subject (str): subject
    - data (StopOrderEvent): event data
"""


class StopOrderEventCallbackWrapper(WebSocketMessageCallback):

    def __init__(self, cb: StopOrderEventCallback):
        self.callback = cb

    def on_message(self, message: WsMessage):
        event = StopOrderEvent.from_dict(message.raw_data)
        event.common_response = message
        self.callback(message.topic, message.subject, event)
