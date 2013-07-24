<?php
/**
 * Class Tracking_Service_GoogleEcommerce
 */
class Tracking_Service_GoogleEcommerce extends Tracking_Service_ServiceAbstract
{
    /**
     * @param null|string $page
     * @return string
     */
    public function generate($page = null)
    {
        $code = '';
        $code .= $this->_generateTransaction();
        $code .= $this->_generateItems();
        $code .= PHP_EOL;
        $code .= '_gaq.push([\'_trackTrans\']);';
        return $code;
    }
    /**
     *
     * @return string
     */
    protected function _generateTransaction()
    {
        $trans = '_gaq.push([\'_addTrans\',';
        $trans .= '\'' . $this->_getData()->getOrderId() . '\',';
        $trans .= '\'' . $this->_getData()->getPortal() . '\',';
        $trans .= '\'' . $this->_getData()->getTotalPrice() . '\',';
        $trans .= '\'' . $this->_getData()->getTax() . '\',';
        $trans .= '\'' . $this->_getData()->getShipping() . '\',';
        $trans .= '\'' . $this->_getData()->getCity() . '\',';
        $trans .= '\'' . $this->_getData()->getRegion() . '\',';
        $trans .= '\'' . $this->_getData()->getCountry() . '\'';
        $trans .= ']);';
        return $trans;
    }

    /**
     *
     * @return string
     */
    protected function _generateItems()
    {
        $items = '';
        foreach ($this->_getData()->getGoogleEcommerceItems() as $item) {
            $items .= $this->_generateItem($item) . PHP_EOL;
        }
        return $items;
    }

    /**
     * @param Tracking_Data_Google_EcommerceItem $item
     * @return string
     */
    protected function _generateItem(Tracking_Data_Google_EcommerceItem $item)
    {
        $text = '_gaq.push([\'_addItem\',';
        $text .= '\'' . $this->_getData()->getOrderId() . '\',';
        $text .= '\'' . $item->getProductCode() . '\',';
        $text .= '\'' . $item->getProductName() . '\',';
        $text .= '\'' . $item->getCategory() . '\',';
        $text .= '\'' . $item->getUnitPrice() . '\',';
        $text .= '\'' . $item->getQuantity() . '\'';
        $text .= ']);';
        return $text;
    }
}