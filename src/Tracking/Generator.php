<?php
/**
 * @author dknx01
 * @package Tracking
 */

/**
 * Class Tracking_Generator
 */
class Tracking_Generator
{
    /**
     * instances of the tracking services
     * @var array
     */
    protected $instances = array();
    /**
     * the generator instance
     * @var Tracking_Generator
     */
    protected static $instance = null;
    /**
     * name of the data object
     * @var string
     */
    protected $dataObjectName = Tracking_Service_ServiceAbstract::DATA_OBJECT_NAME;
    /**
     * the database connection
     * @var PDO
     */
    protected $db = null;
    /**
     * agent to use for different version a site
     * @var int
     */
    protected $agent = 1;

    /**
     * @return Tracking_Generator
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
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
        if (is_null($dataObjectName)) {
            $dataObjectName = $this->getDataObjectName();
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
            if (!array_key_exists($service, $this->instances)) {
                if (!method_exists($className, 'generate')) {
                    throw new Exception('Tracking service ' . ucfirst($service) . ' has no generate function.');
                }
                $this->instances[$service][$dataObjectName] = new $className();
                $this->instances[$service][$dataObjectName]->setDataObjectName($dataObjectName)
                                                           ->setAgent($this->getAgent())
                                                           ->setDbConnection($this->getDb());
            }
            return $this->instances[$service][$dataObjectName]->setAdditionalParameters($additionalParameters)
                                                              ->generate($page);
        } else {
            throw new Exception('Tracking service ' . ucfirst($service) . ' does not exists.');
        }
    }

    /**
     * @param $dataObjectName
     * @return Tracking_Generator
     */
    public function setDataObjectName($dataObjectName)
    {
        $this->dataObjectName = $dataObjectName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataObjectName()
    {
        return $this->dataObjectName;
    }

    /**
     * @param int $agent
     *
     * @return Tracking_Generator
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
        return $this;
    }

    /**
     * @return int
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @param PDO $db
     *
     * @return Tracking_Generator
     */
    public function setDb(PDO $db)
    {
        $this->db = $db;
        return $this;
    }

    /**
     * @return PDO
     */
    public function getDb()
    {
        return $this->db;
    }

}