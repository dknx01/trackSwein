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
    protected $dataObjectName = '';
    protected $dbConnection = null;
    protected $service = null;
    protected $agent = null;
    protected $additionalParameters = null;
    protected $neededParameters = array();
    protected $dbValues = array();

    public function __construct()
    {
        $this->setDataObjectName();
        $this->additionalParameters = new stdClass();
    }

    abstract function generate($page = null);

    protected function getDataObjectName()
    {
        return $this->dataObjectName;
    }

    /**
     * @return Tracking_Data|mixed
     */
    protected function getData()
    {
        $objectName = $this->getDataObjectName();
        return $objectName::getInstance();
    }

    public function setDataObjectName($name = null)
    {
        if (!is_null($name) && !class_exists($name)) {
            throw new Exception('Tracking data class ' . $name . ' does not exists.');
        }
        $this->dataObjectName = !is_null($name) ? $name : self::DATA_OBJECT_NAME;
        return $this;
    }

    /**
     * @param string $page
     * @return array
     */
    protected function getNeededParamsFromDb($page)
    {
        if (!array_key_exists($page, $this->_neededParameters)) {
            $sql = 'SELECT parameter FROM ' . self::PARAMETER_TABLE . ' t'
                 . ' WHERE t.service = ' . $this->getDbConnection()->quote($this->getService())
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

    protected function getValuesFromDb($page) {
        if (!array_key_exists($page, $this->dbValues)) {
            $sql = 'SELECT parameter, value FROM ' . self::VALUE_TABLE
                . ' WHERE service=' . $this->getDbConnection()->quote($this->getService())
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
     * @param mixed $agent
     *
     * @return Tracking_Service_ServiceAbstract
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @return string
     */
    protected function getService()
    {
        if (is_null($this->service)) {
            $calledClass = get_called_class();
            $this->service = substr($calledClass, strrpos($calledClass, '_') + 1);
        }
        return $this->service;
    }

    /**
     * @param PDO $dbConnection
     *
     * @return Tracking_Service_ServiceAbstract
     */
    public function setDbConnection($dbConnection)
    {
        $this->dbConnection = $dbConnection;
        return $this;
    }

    /**
     * @return PDO
     */
    public function getDbConnection()
    {
        return $this->dbConnection;
    }

    /**
     * @param array $dbValues
     *
     * @return Tracking_Service_ServiceAbstract
     */
    public function setDbValues($page, $dbValues)
    {
        $this->dbValues[$page] = $dbValues;
        return $this;
    }

    /**
     * @return array
     */
    public function getDbValues($page)
    {
        return $this->dbValues[$page];
    }

    /**
     * @param array $neendedParameters
     *
     * @return Tracking_Service_ServiceAbstract
     */
    public function setNeededParameters($page, $neendedParameters)
    {
        $this->neededParameters[$page] = $neendedParameters;
        return $this;
    }

    /**
     * @return array
     */
    public function getNeededParameters($page)
    {
        return $this->neededParameters[$page];
    }

    /**
     * @param null|\stdClass $additionalParameters
     *
     * @return Tracking_Service_ServiceAbstract
     */
    public function setAdditionalParameters($additionalParameters)
    {
        $this->additionalParameters = is_null($additionalParameters) ? new stdClass() : $additionalParameters;
        return $this;
    }

    /**
     * @return null|\stdClass
     */
    public function getAdditionalParameters()
    {
        return $this->additionalParameters;
    }

    protected function getParameter($name)
    {
        if (property_exists($this->additionalParameters, $name)) {
            return $this->additionalParameters->$name;
        } else {
            throw new Exception('Tracking service parameter ' . $name . ' does not exists.');
        }
    }
}