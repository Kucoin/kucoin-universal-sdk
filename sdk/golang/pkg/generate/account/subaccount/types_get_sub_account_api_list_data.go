// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package subaccount

// GetSubAccountApiListData struct for GetSubAccountApiListData
type GetSubAccountApiListData struct {
	// Sub Name
	SubName *string `json:"subName,omitempty"`
	// Remarks
	Remark *string `json:"remark,omitempty"`
	// API Key
	ApiKey *string `json:"apiKey,omitempty"`
	// API Version
	ApiVersion *int32 `json:"apiVersion,omitempty"`
	// [Permissions](https://www.kucoin.com/docs-new/doc-338144)
	Permission *string `json:"permission,omitempty"`
	// IP whitelist
	IpWhitelist *string `json:"ipWhitelist,omitempty"`
	// Apikey create time
	CreatedAt *int64 `json:"createdAt,omitempty"`
	// Sub-account UID
	Uid *int32 `json:"uid,omitempty"`
	// Whether it is the master account.
	IsMaster *bool `json:"isMaster,omitempty"`
}

// NewGetSubAccountApiListData instantiates a new GetSubAccountApiListData object
// This constructor will assign default values to properties that have it defined
func NewGetSubAccountApiListData() *GetSubAccountApiListData {
	this := GetSubAccountApiListData{}
	return &this
}

// NewGetSubAccountApiListDataWithDefaults instantiates a new GetSubAccountApiListData object
// This constructor will only assign default values to properties that have it defined,
func NewGetSubAccountApiListDataWithDefaults() *GetSubAccountApiListData {
	this := GetSubAccountApiListData{}
	return &this
}

func (o *GetSubAccountApiListData) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["subName"] = o.SubName
	toSerialize["remark"] = o.Remark
	toSerialize["apiKey"] = o.ApiKey
	toSerialize["apiVersion"] = o.ApiVersion
	toSerialize["permission"] = o.Permission
	toSerialize["ipWhitelist"] = o.IpWhitelist
	toSerialize["createdAt"] = o.CreatedAt
	toSerialize["uid"] = o.Uid
	toSerialize["isMaster"] = o.IsMaster
	return toSerialize
}
