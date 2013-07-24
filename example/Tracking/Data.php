<?php
/**
 * Class Tracking_Data
 */
class Tracking_Data
{
    protected $_additionalData = null;
    protected static $_instance = null;

    protected $_orderId = '';
    protected $_hotelId = '';
    protected $_hotelName = '';
    protected $_organiser ='';
    protected $_provision = 0.0;
    protected $_destination = '';
    protected $_startDate = 0;
    protected $_endDate = 0;
    protected $_numberOfTravellers = 0;
    protected $_numberDaysOfStay = 0;
    protected $_category = '';
    protected $_catering = '';
    protected $_roomType = '';
    protected $_hotelCoreId = 0;
    protected $_totalPrice = 0.0;
    protected $_city = '';
    protected $_region = '';
    protected $_hotelPrice = 0.0;
    protected $_hotelType = '';
    protected $_email = '';
    protected $_currencySymbol = 'EUR';
    protected $_partnerId = '';
    protected $_reviewNote = null;
    protected $_portal = '';
    protected $_tax = 0.0;
    protected $_shipping = 0.0;
    protected $_country = '';
    protected $_googleEcommerceItems = array();
    protected $_stars = 0;

    /**
     * @param string $country
     *
     * @return Tracking_Data
     */
    public function setCountry($country)
    {
        $this->_country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * @param array $googleEcommerceItems
     *
     * @return Tracking_Data
     */
    public function setGoogleEcommerceItems($googleEcommerceItems)
    {
        $this->_googleEcommerceItems = $googleEcommerceItems;
        return $this;
    }

    /**
     * @return array
     */
    public function getGoogleEcommerceItems()
    {
        return $this->_googleEcommerceItems;
    }

    /**
     * @param string $portal
     *
     * @return Tracking_Data
     */
    public function setPortal($portal)
    {
        $this->_portal = $portal;
        return $this;
    }

    /**
     * @return string
     */
    public function getPortal()
    {
        return $this->_portal;
    }

    /**
     * @param float $shipping
     *
     * @return Tracking_Data
     */
    public function setShipping($shipping)
    {
        $this->_shipping = $shipping;
        return $this;
    }

    /**
     * @return float
     */
    public function getShipping()
    {
        return $this->_shipping;
    }

    /**
     * @param float $tax
     *
     * @return Tracking_Data
     */
    public function setTax($tax)
    {
        $this->_tax = $tax;
        return $this;
    }

    /**
     * @return float
     */
    public function getTax()
    {
        return $this->_tax;
    }


    /**
     * @param int $NumberDaysOfStay
     *
     * @return Tracking_Data
     */
    public function setNumberDaysOfStay($NumberDaysOfStay)
    {
        $this->_numberDaysOfStay = $NumberDaysOfStay;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberDaysOfStay()
    {
        return $this->_numberDaysOfStay;
    }

    /**
     * @param null $additionalData
     *
     * @return Tracking_Data
     */
    public function setAdditionalData($additionalData)
    {
        $this->_additionalData = $additionalData;
        return $this;
    }

    /**
     * @return null
     */
    public function getAdditionalData()
    {
        return $this->_additionalData;
    }

    /**
     * @param string $category
     *
     * @return Tracking_Data
     */
    public function setCategory($category)
    {
        $this->_category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * @param string $catering
     *
     * @return Tracking_Data
     */
    public function setCatering($catering)
    {
        $this->_catering = $catering;
        return $this;
    }

    /**
     * @return string
     */
    public function getCatering()
    {
        return $this->_catering;
    }

    /**
     * @param string $currencySymbol
     *
     * @return Tracking_Data
     */
    public function setCurrencySymbol($currencySymbol)
    {
        $this->_currencySymbol = $currencySymbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->_currencySymbol;
    }

    /**
     * @param string $destination
     *
     * @return Tracking_Data
     */
    public function setDestination($destination)
    {
        $this->_destination = $destination;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->_destination;
    }

    /**
     * @param string $email
     *
     * @return Tracking_Data
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param int $endDate as timestamp
     *
     * @return Tracking_Data
     */
    public function setEndDate($endDate)
    {
        $this->_endDate = $endDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getEndDate()
    {
        return $this->_endDate;
    }

    /**
     * @param int $hotelCoreId
     *
     * @return Tracking_Data
     */
    public function setHotelCoreId($hotelCoreId)
    {
        $this->_hotelCoreId = $hotelCoreId;
        return $this;
    }

    /**
     * @return int
     */
    public function getHotelCoreId()
    {
        return $this->_hotelCoreId;
    }

    /**
     * @param string $hotelId
     *
     * @return Tracking_Data
     */
    public function setHotelId($hotelId)
    {
        $this->_hotelId = $hotelId;
        return $this;
    }

    /**
     * @return string
     */
    public function getHotelId()
    {
        return $this->_hotelId;
    }

    /**
     * @param string $hotelName
     *
     * @return Tracking_Data
     */
    public function setHotelName($hotelName)
    {
        $this->_hotelName = $hotelName;
        return $this;
    }

    /**
     * @return string
     */
    public function getHotelName()
    {
        return $this->_hotelName;
    }

    /**
     * @param float $hotelPrice
     *
     * @return Tracking_Data
     */
    public function setHotelPrice($hotelPrice)
    {
        $this->_hotelPrice = $hotelPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getHotelPrice()
    {
        return $this->_hotelPrice;
    }

    /**
     * @param string $hotelType
     *
     * @return Tracking_Data
     */
    public function setHotelType($hotelType)
    {
        $this->_hotelType = $hotelType;
        return $this;
    }

    /**
     * @return string
     */
    public function getHotelType()
    {
        return $this->_hotelType;
    }

    /**
     * @param int $numberOfTravellers
     *
     * @return Tracking_Data
     */
    public function setNumberOfTravellers($numberOfTravellers)
    {
        $this->_numberOfTravellers = $numberOfTravellers;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfTravellers()
    {
        return $this->_numberOfTravellers;
    }

    /**
     * @param string $organiser
     *
     * @return Tracking_Data
     */
    public function setOrganiser($organiser)
    {
        $this->_organiser = $organiser;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrganiser()
    {
        return $this->_organiser;
    }

    /**
     * @param string $partnerId
     *
     * @return Tracking_Data
     */
    public function setPartnerId($partnerId)
    {
        $this->_partnerId = $partnerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerId()
    {
        return $this->_partnerId;
    }

    /**
     * @param float $provision
     *
     * @return Tracking_Data
     */
    public function setProvision($provision)
    {
        $this->_provision = $provision;
        return $this;
    }

    /**
     * @return float
     */
    public function getProvision()
    {
        return $this->_provision;
    }

    /**
     * @param string $region
     *
     * @return Tracking_Data
     */
    public function setRegion($region)
    {
        $this->_region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->_region;
    }

    /**
     * @param Tracking_Data_ReviewNote $reviewNote
     * @return Tracking_Data
     */
    public function setReviewNote(Tracking_Data_ReviewNote $reviewNote)
    {
        $this->_reviewNote = $reviewNote;
        return $this;
    }

    /**
     * @param string $version
     * @return string
     */
    public function getReviewNote($version = 'confirm')
    {
        if (is_null($version)) {
            $version = 'confirm';
        }
        return $this->_reviewNote->generate($this, $version);
    }

    /**
     * @param string $roomType
     *
     * @return Tracking_Data
     */
    public function setRoomType($roomType)
    {
        $this->_roomType = $roomType;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoomType()
    {
        return $this->_roomType;
    }

    /**
     * @param int $startDate as timestamp
     *
     * @return Tracking_Data
     */
    public function setStartDate($startDate)
    {
        $this->_startDate = $startDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getStartDate()
    {
        return $this->_startDate;
    }

    /**
     * @param float $totalPrice
     *
     * @return Tracking_Data
     */
    public function setTotalPrice($totalPrice)
    {
        $this->_totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->_totalPrice;
    }

    /**
     * @param string $city
     *
     * @return Tracking_Data
     */
    public function setCity($city)
    {
        $this->_city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->_city;
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __construct()
    {
        $this->_additionalData = new stdClass();
        $this->setReviewNote(new Tracking_Data_ReviewNote());
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $setter = 'set' . ucfirst($name);
            $this->$setter($value);
        } else {
            $this->_additionalData->$name = $value;
        }
        return $this;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            $getter = 'get' . ucfirst($name);
            return $this->$getter();
        } elseif(property_exists($this->_additionalData, $name)) {
            return $this->_additionalData->$name;
        } else {
            throw new Exception('Tracking property ' . $name . ' does not exists.');
        }
    }

    /**
     * @param string $orderId
     *
     * @return Tracking_Data
     */
    public function setOrderId($orderId)
    {
        $this->_orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->_orderId;
    }

    /**
     * @param null|\stdClass $__additionalData
     *
     * @return Tracking_Data
     */
    public function set_additionalData($__additionalData)
    {
        $this->_additionalData = $__additionalData;
        return $this;
    }

    /**
     * @return null|\stdClass
     */
    public function get_additionalData()
    {
        return $this->_additionalData;
    }

    /**
     * @param Tracking_Data_Google_EcommerceItem $_item
     * @return Tracking_Data
     */
    public function addGoogleEcommerceItem(Tracking_Data_Google_EcommerceItem $_item)
    {
        $this->_googleEcommerceItems[] = $_item;
        $this->setTotalPrice($this->getTotalPrice() + $_item->getUnitPrice());
        return $this;
    }

    /**
     * @param int $stars
     *
     * @return Tracking_Data
     */
    public function setStars($stars)
    {
        $this->_stars = $stars;
        return $this;
    }

    /**
     * @return int
     */
    public function getStars()
    {
        return $this->_stars;
    }
}