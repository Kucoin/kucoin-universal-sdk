// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

package ndbroker

// DeleteSubAccountAPIReq struct for DeleteSubAccountAPIReq
type DeleteSubAccountAPIReq struct {
	// Sub-account UID
	Uid *string `json:"uid,omitempty" url:"uid,omitempty"`
	// Sub-account apiKey
	ApiKey *string `json:"apiKey,omitempty" url:"apiKey,omitempty"`
}

// NewDeleteSubAccountAPIReq instantiates a new DeleteSubAccountAPIReq object
// This constructor will assign default values to properties that have it defined
func NewDeleteSubAccountAPIReq() *DeleteSubAccountAPIReq {
	this := DeleteSubAccountAPIReq{}
	return &this
}

// NewDeleteSubAccountAPIReqWithDefaults instantiates a new DeleteSubAccountAPIReq object
// This constructor will only assign default values to properties that have it defined,
func NewDeleteSubAccountAPIReqWithDefaults() *DeleteSubAccountAPIReq {
	this := DeleteSubAccountAPIReq{}
	return &this
}

func (o *DeleteSubAccountAPIReq) ToMap() map[string]interface{} {
	toSerialize := map[string]interface{}{}
	toSerialize["uid"] = o.Uid
	toSerialize["apiKey"] = o.ApiKey
	return toSerialize
}

type DeleteSubAccountAPIReqBuilder struct {
	obj *DeleteSubAccountAPIReq
}

func NewDeleteSubAccountAPIReqBuilder() *DeleteSubAccountAPIReqBuilder {
	return &DeleteSubAccountAPIReqBuilder{obj: NewDeleteSubAccountAPIReqWithDefaults()}
}

// Sub-account UID
func (builder *DeleteSubAccountAPIReqBuilder) SetUid(value string) *DeleteSubAccountAPIReqBuilder {
	builder.obj.Uid = &value
	return builder
}

// Sub-account apiKey
func (builder *DeleteSubAccountAPIReqBuilder) SetApiKey(value string) *DeleteSubAccountAPIReqBuilder {
	builder.obj.ApiKey = &value
	return builder
}

func (builder *DeleteSubAccountAPIReqBuilder) Build() *DeleteSubAccountAPIReq {
	return builder.obj
}
