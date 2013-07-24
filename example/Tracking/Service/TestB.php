<?php
/**
 * Class Tracking_Service_TestB
 */
class Tracking_Service_TestB extends Tracking_Service_ServiceAbstract
{
    /**
     * @param null|string $page
     * @return string
     */
    public function generate($page = null)
    {
        var_dump($this->_getNeededParamsFromDb('bs2'));
        var_dump($this->_getValuesFromDb('bs2'));
        $code = '';
        foreach ($this->_getNeededParamsFromDb('bs2') as $param) {
            $code .= $param . '#';
        }
        return $code;
    //    return print_r($this->_getData()->getGoogleEcommerceItems(), true);
    }
}