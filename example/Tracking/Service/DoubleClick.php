<?php
/**
 * Class Tracking_Service_DoubleClick
 */
class Tracking_Service_DoubleClick extends Tracking_Service_ServiceAbstract
{
    protected $_map = array(
                        'u2' => 'HotelId',
                        'u3' => 'HotelName',
                        'u4' => 'organiser',
                        'u5' => 'provision',
                        'u6' => 'destination',
                        'u7' => 'startDate',
                        'u8' => 'endDate',
                        'u9' => 'numberOfTravelers',
                        'u11' => 'numberDaysOfStay',
                        'u12' => 'Category',
                        'u13' => 'Catering',
                        'u14' => 'RoomType',
                        'u15' => 'HotelCoreId',
                        'u16' => 'HotelType',
                        'u17' => 'Price',
                        'u19' => 'City',
                        'u20' => 'Region',
                        'cost' => 'TotalPrice',
                        'ord' => 'OrderId'
                    );
    protected $_delimiter = ';';

    /**
     * @param null|string $page
     * @return string
     */
    public function generate($page = null)
    {
        $params = '';
        $params .= $this->_getDbValues($page);
        foreach ($this->_getNeededParamsFromDb($page) as $parameter) {
//            $getter = 'get' . ucfirst($this->_map[$parameter]);
            $params .= $parameter . '=' . urlencode($this->_getTrackingData($parameter)) . $this->getDelimiter();
//            $getter = 'get' . ucfirst($parameter);
//            $params .= $parameter . '=' . $this->_setting->$getter() . $delimiter;
        }
        $params = substr($params, 0, -1);
        return $params;
    }

    /**
     * @param string $parameter
     * @return string
     */
    protected function _getTrackingData($parameter) {
        $getter = 'get' . ucfirst($this->_map[$parameter]);
        $value = $this->_getData()->$getter();
        if ($parameter == 'u7' || $parameter == 'u8') {
            var_dump($value);
            $value = date('m:d:Y' ,$value);
        }
        return (string)$value;
    }

    /**
     * @param string $page
     * @return string
     */
    protected function _getDbValues($page) {
        $values = $this->_getValuesFromDb($page);
        $src = array_key_exists('src', $values) ? $values['src'][0] : '';
        $type = array_key_exists('type', $values) ? $values['type'][0] : '';
        $cat = array_key_exists('cat', $values) ? $values['cat'][0] : '';
        return  'src=' . $src . ';type=' . $type . ';cat=' . $cat . ';';
    }

    /**
     * @param string $delimiter
     *
     * @return Tracking_Service_DoublceClick
     */
    public function setDelimiter($delimiter)
    {
        $this->_delimiter = $delimiter;
        return $this;
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return $this->_delimiter;
    }

    /**
     * generiert eine zufällige Zahl
     *
     * @return string
     */
    public static function generateRandomOrderNumber()
    {
        $ord = mt_rand();
        $ord = $ord * 10000000000000;
        return number_format($ord, 0, '', '');
    }
}