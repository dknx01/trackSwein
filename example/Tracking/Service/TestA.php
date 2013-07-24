<?php
/**
 * Class Tracking_Service_TestA
 */
class Tracking_Service_TestA extends Tracking_Service_ServiceAbstract
{
    /**
     * @param null|string $page
     * @return string
     */
    public function generate($page = null)
    {
        $this->_getNeededParamsFromDb();
        $this->_getValuesFromDb();
        return '###' . $this->_getData()->getOrderId();
    }
}