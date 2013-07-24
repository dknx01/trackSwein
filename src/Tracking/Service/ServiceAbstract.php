<?php
/**
 * @author dknx01
 * @package Tracking\Service
 */
/**
 * Class Tracking_Service_ServiceAbstract
 */
abstract class Tracking_Service_ServiceAbstract
{
    const PARAMETER_TABLE = 'Tracking_Config';
    const VALUE_TABLE = 'Tracking_Value';
    const DATA_OBJECT_NAME = 'Tracking_Data';
    protected $_dataObjectName = '';
    protected $_dbConnection = null;
    protected $_service = null;
    protected $_agent = null;
    protected $_additionalParameters = null;
    protected $_neededParameters = array();
    protected $_dbValues = array();

    public function __construct()
    {
        $this->setDataObjectName();
        $this->_additionalParameters = new stdClass();
    }

    abstract function generate($page = null);

    protected function _getDataObjectName()
    {
        return $this->_dataObjectName;
    }

    /**
     * @return Tracking_Data|mixed
     */
    protected function _getData()
    {
        $objectName = $this->_getDataObjectName();
        return $objectName::getInstance();
    }

    public function setDataObjectName($name = null)
    {
        if (!is_null($name) && !class_exists($name)) {
            throw new Exception('Tracking data class ' . $name . ' does not exists.');
        }
        $this->_dataObjectName = !is_null($name) ? $name : self::DATA_OBJECT_NAME;
        return $this;
    }

    /**
     * @param string $page
     * @return array
     */
    protected function _getNeededParamsFromDb($page)
    {
        if (!array_key_exists($page, $this->_neededParameters)) {
            $sql = 'SELECT parameter FROM ' . self::PARAMETER_TABLE . ' t'
                 . ' WHERE t.service = ' . $this->getDbConnection()->quote($this->_getService())
                 . ' AND t.agent=' . $this->getDbConnection()->quote($this->getAgent())
                 . ' AND t.page=' . $this->getDbConnection()->quote($page)
                 . ' ORDER BY t.position ASC';
            $result = $this->getDbConnection()->query($sql)->fetchAll();
            $parameters = array();
            foreach ($result as $row) {
                $parameters[] = $row['parameter'];
            }
            $this->setNeededParameters($page, $parameters);
        }
        return $this->getNeededParameters($page);
    }

    protected function _getValuesFromDb($page) {
        if (!array_key_exists($page, $this->_dbValues)) {
            $sql = 'SELECT parameter, value FROM ' . self::VALUE_TABLE
                . ' WHERE service=' . $this->getDbConnection()->quote($this->_getService())
                . ' AND agent=' . $this->getDbConnection()->quote($this->getAgent())
                . ' AND page=' . $this->getDbConnection()->quote($page);
            $result = $this->getDbConnection()->query($sql)->fetchAll();
            $values = array();
            foreach ($result as $row) {
                $values[$row['parameter']][] = $row['value'];
            }
            $this->setDbValues($page, $values);
        }
        return $this->getDbValues($page);
    }

    /**
     * @param null $agent
     *
     * @return ${NAMESPACE}
     */
    public function setAgent($agent)
    {
        $this->_agent = $agent;
        return $this;
    }

    /**
     * @return null
     */
    public function getAgent()
    {
        return $this->_agent;
    }

    /**
     * @return string
     */
    protected function _getService()
    {
        if (is_null($this->_service)) {
            $calledClass = get_called_class();
            $this->_service = substr($calledClass, strrpos($calledClass, '_') + 1);
        }
        return $this->_service;
    }

    /**
     * @param PDO $dbConnection
     *
     * @return ${NAMESPACE}
     */
    public function setDbConnection($dbConnection)
    {
        $this->_dbConnection = $dbConnection;
        return $this;
    }

    /**
     * @return PDO
     */
    public function getDbConnection()
    {
        return $this->_dbConnection;
    }

    /**
     * @param array $dbValues
     *
     * @return ${NAMESPACE}
     */
    public function setDbValues($page, $dbValues)
    {
        $this->_dbValues[$page] = $dbValues;
        return $this;
    }

    /**
     * @return array
     */
    public function getDbValues($page)
    {
        return $this->_dbValues[$page];
    }

    /**
     * @param array $neendedParameters
     *
     * @return ${NAMESPACE}
     */
    public function setNeededParameters($page, $neendedParameters)
    {
        $this->_neededParameters[$page] = $neendedParameters;
        return $this;
    }

    /**
     * @return array
     */
    public function getNeededParameters($page)
    {
        return $this->_neededParameters[$page];
    }

    /**
     * @param null|\stdClass $additionalParameters
     *
     * @return Tracking_Service_ServiceAbstract
     */
    public function setAdditionalParameters($additionalParameters)
    {
        $this->_additionalParameters = is_null($additionalParameters) ? new stdClass() : $additionalParameters;
        return $this;
    }

    /**
     * @return null|\stdClass
     */
    public function getAdditionalParameters()
    {
        return $this->_additionalParameters;
    }

    protected function _getParameter($name)
    {
        if (property_exists($this->_additionalParameters, $name)) {
            return $this->_additionalParameters->$name;
        } else {
            throw new Exception('Tracking service parameter ' . $name . ' does not exists.');
        }
    }
}