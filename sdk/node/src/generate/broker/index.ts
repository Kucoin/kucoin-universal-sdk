import * as APIBROKER from './apibroker';
import * as NDBROKER from './ndbroker';
export const Broker = {
    APIBroker: APIBROKER,
    NDBroker: NDBROKER,
};
export namespace Broker {
    export type APIBrokerAPI = APIBROKER.APIBrokerAPI;
    export type NDBrokerAPI = NDBROKER.NDBrokerAPI;
    export namespace APIBroker {
        export type GetRebaseReq = APIBROKER.GetRebaseReq;
        export type GetRebaseResp = APIBROKER.GetRebaseResp;
    }
    export namespace NDBroker {
        export type AddSubAccountApiReq = NDBROKER.AddSubAccountApiReq;
        export type AddSubAccountApiResp = NDBROKER.AddSubAccountApiResp;
        export type AddSubAccountReq = NDBROKER.AddSubAccountReq;
        export type AddSubAccountResp = NDBROKER.AddSubAccountResp;
        export type DeleteSubAccountAPIReq = NDBROKER.DeleteSubAccountAPIReq;
        export type DeleteSubAccountAPIResp = NDBROKER.DeleteSubAccountAPIResp;
        export type GetBrokerInfoReq = NDBROKER.GetBrokerInfoReq;
        export type GetBrokerInfoResp = NDBROKER.GetBrokerInfoResp;
        export type GetDepositDetailReq = NDBROKER.GetDepositDetailReq;
        export type GetDepositDetailResp = NDBROKER.GetDepositDetailResp;
        export type GetDepositListData = NDBROKER.GetDepositListData;
        export type GetDepositListReq = NDBROKER.GetDepositListReq;
        export type GetDepositListResp = NDBROKER.GetDepositListResp;
        export type GetKYCStatusData = NDBROKER.GetKYCStatusData;
        export type GetKYCStatusListItems = NDBROKER.GetKYCStatusListItems;
        export type GetKYCStatusListReq = NDBROKER.GetKYCStatusListReq;
        export type GetKYCStatusListResp = NDBROKER.GetKYCStatusListResp;
        export type GetKYCStatusReq = NDBROKER.GetKYCStatusReq;
        export type GetKYCStatusResp = NDBROKER.GetKYCStatusResp;
        export type GetRebaseReq = NDBROKER.GetRebaseReq;
        export type GetRebaseResp = NDBROKER.GetRebaseResp;
        export type GetSubAccountAPIData = NDBROKER.GetSubAccountAPIData;
        export type GetSubAccountAPIReq = NDBROKER.GetSubAccountAPIReq;
        export type GetSubAccountAPIResp = NDBROKER.GetSubAccountAPIResp;
        export type GetSubAccountItems = NDBROKER.GetSubAccountItems;
        export type GetSubAccountReq = NDBROKER.GetSubAccountReq;
        export type GetSubAccountResp = NDBROKER.GetSubAccountResp;
        export type GetTransferHistoryReq = NDBROKER.GetTransferHistoryReq;
        export type GetTransferHistoryResp = NDBROKER.GetTransferHistoryResp;
        export type GetWithdrawDetailReq = NDBROKER.GetWithdrawDetailReq;
        export type GetWithdrawDetailResp = NDBROKER.GetWithdrawDetailResp;
        export type ModifySubAccountApiReq = NDBROKER.ModifySubAccountApiReq;
        export type ModifySubAccountApiResp = NDBROKER.ModifySubAccountApiResp;
        export type SubmitKYCReq = NDBROKER.SubmitKYCReq;
        export type SubmitKYCResp = NDBROKER.SubmitKYCResp;
        export type TransferReq = NDBROKER.TransferReq;
        export type TransferResp = NDBROKER.TransferResp;
    }
}
