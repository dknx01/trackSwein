<?php
class MockPdo extends PDO
{
    protected $query = '';
    public $params = array(
                        array('parameter' => 'u7'),
                        array('parameter' => 'foo')
                    );
    public $values = array(
                        array('parameter' => 'foo', 'value' => 'bar')
                    );
    public function __construct()
    {}
    public function quote($arg)
    {
        return '`' . $arg . '`';
    }
    public function query($sql)
    {
        $this->query = strpos($sql, Tracking_Service_ServiceAbstract::PARAMETER_TABLE) ? 'parameter' : 'value';
        return $this;
    }
    public function fetchAll()
    {
        if ($this->query == 'parameter') {
            return $this->params;
        } elseif ($this->query == 'value') {
            return $this->values;
        } else {
            return false;
        }
    }
}