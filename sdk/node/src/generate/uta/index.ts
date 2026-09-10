import * as ACCOUNT from './account';
import * as AFFILIATE from './affiliate';
import * as MARKET from './market';
import * as ORDER from './order';
import * as POSITIONS from './positions';
import * as PRIVATEWS from './privatews';
import * as PUBLICWS from './publicws';
import * as VIP_LENDING from './viplending';

export * from './common';

/**
 * UTA API type namespace.
 *
 * Several UTA service groups have method-specific types with the same name (for example,
 * `GetTradeHistoryReq`). Keeping them below their service group mirrors the Java package layout
 * and prevents ambiguous exports from the SDK root.
 */
export const UTA = {
    Account: ACCOUNT,
    Affiliate: AFFILIATE,
    Market: MARKET,
    Order: ORDER,
    Positions: POSITIONS,
    PrivateWS: PRIVATEWS,
    PublicWS: PUBLICWS,
    VIPLending: VIP_LENDING,
};

export namespace Uta {
    export type AccountAPI = ACCOUNT.AccountAPI;
    export type AffiliateAPI = AFFILIATE.AffiliateAPI;
    export type MarketAPI = MARKET.MarketAPI;
    export type OrderAPI = ORDER.OrderAPI;
    export type PositionsAPI = POSITIONS.PositionsAPI;
    export type UtaPrivateWS = PRIVATEWS.UtaPrivateWS;
    export type UtaPrivateTradeWS = PRIVATEWS.UtaPrivateTradeWS;
    export type UtaPublicWS = PUBLICWS.UtaPublicWS;
    export type VIPLendingAPI = VIP_LENDING.VIPLendingAPI;

    export import Account = ACCOUNT;
    export import Affiliate = AFFILIATE;
    export import Market = MARKET;
    export import Order = ORDER;
    export import Positions = POSITIONS;
    export import PrivateWS = PRIVATEWS;
    export import PublicWS = PUBLICWS;
    export import VIPLending = VIP_LENDING;
}
