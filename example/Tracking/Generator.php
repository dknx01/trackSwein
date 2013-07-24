<?php
/**
 * Class Tracking_Generator
 */
class Tracking_Generator
{
    protected $_instances = array();
    protected static $_instance = null;
    protected $_dataObjectName = Tracking_Service_ServiceAbstract::DATA_OBJECT_NAME;
    protected $_db = null;
    protected $_agent = 1;

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param $service
     * @param string $page the identifier
     * @param stdClass $additionalParameters optional additional data needed for tracking
     * @param string $dataObjectName optional dataobject name if not Tracking_Data
     * @return mixed
     * @throws Exception
     */
    public function generate($service, $page = '', $additionalParameters = null, $dataObjectName = null)
    {
        if (!is_null($dataObjectName)) {
            $this->setDataObjectName($dataObjectName);
        }
        if (!is_null($additionalParameters) && is_array($additionalParameters)) {
            $params = $additionalParameters;
            $additionalParameters = new stdClass();
            foreach ($params as $key => $value) {
                $additionalParameters->$key = $value;
            }
        }
        $className = 'Tracking_Service_' . ucfirst($service);
        if (class_exists($className)) {
            if (!array_key_exists($service, $this->_instances)) {
                if (!method_exists($className, 'generate')) {
                    throw new Exception('Tracking service ' . ucfirst($service) . ' has no generate function.');
                }
                $this->_instances[$service][$this->getDataObjectName()] = new $className();
                $this->_instances[$service][$this->getDataObjectName()]->setDataObjectName($this->getDataObjectName())
                                                                       ->setAgent($this->getAgent())
                                                                       ->setDbConnection($this->getDb());
            }
            return $this->_instances[$service][$this->getDataObjectName()]
                                                ->setAdditionalParameters($additionalParameters)
                                                ->generate($page);
        } else {
            throw new Exception('Tracking service ' . ucfirst($service) . ' does not exits');
        }
    }

    public function generateC()
    {
        if (!array_key_exists('C', $this->_instances)) {
            $this->_instances['C'] = new Tracking_Service_TestC();
        }
        return $this->_instances['C']->run();
    }

    /**
     * @param $dataObjectName
     * @return Tracking_Generator
     */
    public function setDataObjectName($dataObjectName)
    {
        $this->_dataObjectName = $dataObjectName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataObjectName()
    {
        return $this->_dataObjectName;
    }

    /**
     * @param int $agent
     *
     * @return Tracking_Generator
     */
    public function setAgent($agent)
    {
        $this->_agent = $agent;
        return $this;
    }

    /**
     * @return int
     */
    public function getAgent()
    {
        return $this->_agent;
    }

    /**
     * @param null $db
     *
     * @return Tracking_Generator
     */
    public function setDb($db)
    {
        $this->_db = $db;
        return $this;
    }

    /**
     * @return null
     */
    public function getDb()
    {
        return $this->_db;
    }

}