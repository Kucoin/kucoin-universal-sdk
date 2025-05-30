<?php
// Code generated by Kucoin Universal SDK Generator; DO NOT EDIT.

namespace KuCoin\UniversalSDK\Generate\Spot\Market;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Serializer;
use KuCoin\UniversalSDK\Internal\Interfaces\Serializable;

class GetAnnouncementsReq implements Serializable
{
    /**
     * @var string[] $pathVarMapping
     * @Exclude()
     */
    public static $pathVarMapping = [];

    public function pathVarMapping()
    {
        return self::$pathVarMapping;
    }
    /**
     * page number
     * @var int|null $currentPage
     * @Type("int")
     * @SerializedName("currentPage")
     */
    public $currentPage;
    /**
     * page Size
     * @var int|null $pageSize
     * @Type("int")
     * @SerializedName("pageSize")
     */
    public $pageSize;
    /**
     * Announcement types: latest-announcements , activities (latest activities), new-listings (new currency online), product-updates (product updates), vip (institutions and VIPs), maintenance-updates (system maintenance), product -updates (product news), delistings (currency offline), others, api-campaigns (API user activities), default : latest-announcements
     * - 'latest-announcements' : latest-announcements
     * - 'activities' : latest activities
     * - 'product-updates' : product updates
     * - 'vip' : institutions and VIPs
     * - 'maintenance-updates' : system maintenance
     * - 'delistings' : currency offline
     * - 'others' : others
     * - 'api-campaigns' : API user activities
     * - 'new-listings' : new currency online
     * @var string|null $annType
     * @Type("string")
     * @SerializedName("annType")
     */
    public $annType = "latest-announcements";
    /**
     * Language type, the default is en_US, the specific value parameters are as follows
     * - 'zh_HK' : Chinese (Hong Kong)
     * - 'ja_JP' : Japanese (Japan)
     * - 'ko_KR' : Korean (Korea)
     * - 'en_US' : English
     * - 'pl_PL' : Polish (Poland)
     * - 'es_ES' : Spanish (Spain)
     * - 'fr_FR' : French (France)
     * - 'ar_AE' : Arabic (Egypt)
     * - 'it_IT' : Italian (Italy)
     * - 'id_ID' : Indonesian (Indonesia)
     * - 'nl_NL' : Dutch (Netherlands)
     * - 'pt_PT' : Portuguese (Brazil)
     * - 'vi_VN' : Vietnamese (Vietnam)
     * - 'de_DE' : German (Germany)
     * - 'tr_TR' : Turkish (Turkey)
     * - 'ms_MY' : Malay (Malaysia)
     * - 'ru_RU' : Russian (Russia)
     * - 'th_TH' : Thai (Thailand)
     * - 'hi_IN' : Hindi (India)
     * - 'bn_BD' : Bengali (Bangladesh)
     * - 'fil_PH' : Filipino (Philippines)
     * - 'ur_PK' : Urdu (Pakistan)
     * @var string|null $lang
     * @Type("string")
     * @SerializedName("lang")
     */
    public $lang = "en_US";
    /**
     * Announcement online start time (milliseconds)
     * @var int|null $startTime
     * @Type("int")
     * @SerializedName("startTime")
     */
    public $startTime;
    /**
     * Announcement online end time (milliseconds)
     * @var int|null $endTime
     * @Type("int")
     * @SerializedName("endTime")
     */
    public $endTime;

    private function __construct() {}

    /**
     * @param Serializer $serializer
     * @return string
     */
    public function jsonSerialize($serializer)
    {
        return $serializer->serialize($this, "json");
    }

    /**
     * @param string $json
     * @param Serializer $serializer
     * @return self
     */
    public static function jsonDeserialize($json, $serializer)
    {
        if ($json === null) {
            return new self();
        }
        return $serializer->deserialize(
            $json,
            GetAnnouncementsReq::class,
            "json"
        );
    }
    /**
     * Creates a new instance of the `GetAnnouncementsReq` class.
     * The builder pattern allows step-by-step construction of a `GetAnnouncementsReq` object.
     * @return GetAnnouncementsReqBuilder
     */
    public static function builder()
    {
        return new GetAnnouncementsReqBuilder(new self());
    }

    /**
     * Creates a new instance of the `GetAnnouncementsReq` class with the given data.
     * Ensure that the keys in data match the target field names in the documentation,
     * rather than the variable names in the class.
     * @return self
     */
    public static function create(array $data)
    {
        $obj = new self();
        foreach ($data as $key => $value) {
            if (property_exists($obj, $key)) {
                $obj->$key = $value;
            }
        }
        return $obj;
    }
}

class GetAnnouncementsReqBuilder
{
    /**
     * @var GetAnnouncementsReq $obj
     */
    private $obj;

    public function __construct(GetAnnouncementsReq $obj)
    {
        $this->obj = $obj;
    }
    /**
     * page number
     * @param int $value
     * @return self
     */
    public function setCurrentPage($value)
    {
        $this->obj->currentPage = $value;
        return $this;
    }

    /**
     * page Size
     * @param int $value
     * @return self
     */
    public function setPageSize($value)
    {
        $this->obj->pageSize = $value;
        return $this;
    }

    /**
     * Announcement types: latest-announcements , activities (latest activities), new-listings (new currency online), product-updates (product updates), vip (institutions and VIPs), maintenance-updates (system maintenance), product -updates (product news), delistings (currency offline), others, api-campaigns (API user activities), default : latest-announcements
     * - 'latest-announcements' : latest-announcements
     * - 'activities' : latest activities
     * - 'product-updates' : product updates
     * - 'vip' : institutions and VIPs
     * - 'maintenance-updates' : system maintenance
     * - 'delistings' : currency offline
     * - 'others' : others
     * - 'api-campaigns' : API user activities
     * - 'new-listings' : new currency online
     * @param string $value
     * @return self
     */
    public function setAnnType($value)
    {
        $this->obj->annType = $value;
        return $this;
    }

    /**
     * Language type, the default is en_US, the specific value parameters are as follows
     * - 'zh_HK' : Chinese (Hong Kong)
     * - 'ja_JP' : Japanese (Japan)
     * - 'ko_KR' : Korean (Korea)
     * - 'en_US' : English
     * - 'pl_PL' : Polish (Poland)
     * - 'es_ES' : Spanish (Spain)
     * - 'fr_FR' : French (France)
     * - 'ar_AE' : Arabic (Egypt)
     * - 'it_IT' : Italian (Italy)
     * - 'id_ID' : Indonesian (Indonesia)
     * - 'nl_NL' : Dutch (Netherlands)
     * - 'pt_PT' : Portuguese (Brazil)
     * - 'vi_VN' : Vietnamese (Vietnam)
     * - 'de_DE' : German (Germany)
     * - 'tr_TR' : Turkish (Turkey)
     * - 'ms_MY' : Malay (Malaysia)
     * - 'ru_RU' : Russian (Russia)
     * - 'th_TH' : Thai (Thailand)
     * - 'hi_IN' : Hindi (India)
     * - 'bn_BD' : Bengali (Bangladesh)
     * - 'fil_PH' : Filipino (Philippines)
     * - 'ur_PK' : Urdu (Pakistan)
     * @param string $value
     * @return self
     */
    public function setLang($value)
    {
        $this->obj->lang = $value;
        return $this;
    }

    /**
     * Announcement online start time (milliseconds)
     * @param int $value
     * @return self
     */
    public function setStartTime($value)
    {
        $this->obj->startTime = $value;
        return $this;
    }

    /**
     * Announcement online end time (milliseconds)
     * @param int $value
     * @return self
     */
    public function setEndTime($value)
    {
        $this->obj->endTime = $value;
        return $this;
    }

    /**
     * Get the final object.
     * @return GetAnnouncementsReq
     */
    public function build()
    {
        return $this->obj;
    }
}
