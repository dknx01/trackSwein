<?php
/**
 * _data object for Google Analytics _data items (eCommerce)
 *
 * @package    Tracking\Data\Google
 */

class Tracking_Data_Google_EcommerceItem
{
    /**
     *
     * @var string
     */
    protected $_productCode = '';
    /**
     *
     * @var string
     */
    protected $_productName = 'undefined';
    /**
     *
     * @var string
     */
    protected $_category = 'undefined';
    /**
     *
     * @var float
     */
    protected $_unitPrice = 0.0;
    /**
     *
     * @var int
     */
    protected $_quantity = 1;

    /**
     * @return string
     */
    public function getProductCode()
    {
        return $this->_productCode;
    }

    /**
     * @param string $_productCode
     * @return Tracking_Data_Google_EcommerceItem
     */
    public function setProductCode($_productCode)
    {
        $this->_productCode = $_productCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->_productName;
    }

    /**
     * @param string $_productName
     * @return Tracking_Data_Google_EcommerceItem
     */
    public function setProductName($_productName)
    {
        $this->_productName = $_productName;
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
     * @param string $_category
     * @return Tracking_Data_Google_EcommerceItem
     */
    public function setCategory($_category)
    {
        $this->_category = $_category;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitPrice()
    {
        return (string)$this->_unitPrice;
    }

    /**
     * @param float $_unitPrice
     * @return Tracking_Data_Google_EcommerceItem
     */
    public function setUnitPrice($_unitPrice)
    {
        $this->_unitPrice = $_unitPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuantity()
    {
        return (string)$this->_quantity;
    }

    /**
     * @param int $_quantity
     * @return Tracking_Data_Google_EcommerceItem
     */
    public function setQuantity($_quantity)
    {
        $this->_quantity = $_quantity;
        return $this;
    }

    /**
     *
     * @param int $id
     * @throws Exception
     * @return string
     */
    public function getSupplierById($id)
    {
        $return = '';
        try {
            $db = new Zend_Db_Select(Zend_Registry::get(_DB));
            $result = $db->from('Agents_Mapping')->where('AgentId=?', (int)$id)->limit(1)->query()->fetchAll();
            $return = $result[0]['Name'];
        } catch (Exception $e) {
            throw new Exception($e);
        }
        return $return;
    }
}