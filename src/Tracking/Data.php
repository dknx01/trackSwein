<?php
/**
 * @author dknx01
 * @package Tracking
 */

/**
 * Class Tracking_Data
 */
class Tracking_Data
{
    /**
     * @var stdClass
     */
    protected $additionalData = null;
    /**
     * @var string
     */
    protected $name = '';
    /**
     * @var int
     */
    protected $id = 0;
    /**
     * @var Tracking_Data
     */
    protected static $instance = null;

    /**
     * @return Tracking_Data
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->additionalData = new stdClass();
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return Tracking_Data
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $setter = 'set' . ucfirst($name);
            $this->$setter($value);
        } else {
            $this->additionalData->$name = $value;
        }
        return $this;
    }

    /**
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            $getter = 'get' . ucfirst($name);
            return $this->$getter();
        } elseif(property_exists($this->additionalData, $name)) {
            return $this->additionalData->$name;
        } else {
            throw new Exception('Tracking property ' . $name . ' does not exists.');
        }
    }

    /**
     * @param int $id
     *
     * @return Tracking_Data
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @return Tracking_Data
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param stdClass $additionalData
     *
     * @return Tracking_Data
     */
    public function setAdditionalData(stdClass $additionalData)
    {
        $this->additionalData = $additionalData;
        return $this;
    }

    /**
     * @return stdClass
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }
}