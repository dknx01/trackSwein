<?php
/**
 * 
 * @author dknx01 <e.witthauer@gmail.com>
 * @since 26.07.13 20:27
 * @package
 * 
 */

class Tracking_Service_ServiceAbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Tracking_Service_Bar
     */
    protected $bar = null;
    public function setUp()
    {
        $this->bar = new Tracking_Service_Bar();
    }
    public function testAgent()
    {
        $this->bar->setAgent(5);
        $this->assertEquals(5, $this->bar->getAgent());
    }
    public function testDbValues()
    {
        $data = array('bla' => 'bla', 'jep' => 'nö');
        $this->bar->setDbValues('bar', $data);
        $this->assertEquals($data, $this->bar->getDbValues('bar'));
    }
    public function testNeededParameters()
    {
        $this->bar->setNeededParameters('bar', array('u1', 'u5'));
        $this->assertEquals(array('u1', 'u5'), $this->bar->getNeededParameters('bar'));
    }
    public function testAdditionalParametersWithNull()
    {
        $this->bar->setAdditionalParameters(null);
        $this->assertInstanceOf('stdClass', $this->bar->getAdditionalParameters());
    }
    public function testAdditionalParametersWithData()
    {
        $data = new stdClass();
        $data->foo = 'bar';
        $this->bar->setAdditionalParameters($data);
        $this->assertEquals($data, $this->bar->getAdditionalParameters());
    }
    public function testGetAdditionalParameters()
    {
        $reflection = new ReflectionClass('Tracking_Service_Bar');
        $method = $reflection->getMethod('getParameter');
        $method->setAccessible(true);
        $data = new stdClass();
        $data->foo = 'bar';
        $this->bar->setAdditionalParameters($data);
        $this->assertEquals('bar', $method->invokeArgs($this->bar, array('foo')));
    }
    public function testGetAdditionalParametersWithException()
    {
        $reflection = new ReflectionClass('Tracking_Service_Bar');
        $method = $reflection->getMethod('getParameter');
        $method->setAccessible(true);
        $data = new stdClass();
        $data->foo = 'bar';
        $this->bar->setAdditionalParameters($data);
        try {
            $method->invokeArgs($this->bar, array('bla'));
        } catch (Exception $e)
        {
            $this->assertEquals('Tracking service parameter bla does not exists.', $e->getMessage());
        }
    }
    public function testSetDbConnection()
    {
        $this->bar->setDbConnection(new MockPdo());
        $this->assertInstanceOf('PDO', $this->bar->getDbConnection());
    }
    public function testServcie()
    {
        $reflection = new ReflectionClass('Tracking_Service_Bar');
        $method = $reflection->getMethod('getService');
        $method->setAccessible(true);
        $this->assertEquals('Bar', $method->invoke($this->bar));
    }
    public function testSetDataObjectNameWithException()
    {
        try {
            $this->bar->setDataObjectName('Tracking_Data_nope');
        } catch (Exception $e) {
            $this->assertEquals('Tracking data class Tracking_Data_nope does not exists.', $e->getMessage());
        }
    }
    public function testGenerate()
    {
        $this->assertEquals('Tracking', $this->bar->generate());
    }
    public function testGetdata()
    {
        $data = new Tracking_Data();
        $reflection = new ReflectionClass('Tracking_Service_Bar');
        $method = $reflection->getMethod('getData');
        $method->setAccessible(true);
        $this->assertEquals($data, $method->invoke($this->bar));
    }
    public function testGetNeededParamsFromDb()
    {
        $db = new MockPdo();
        $this->bar->setDbConnection($db);
        $reflection = new ReflectionClass('Tracking_Service_Bar');
        $method = $reflection->getMethod('getNeededParamsFromDb');
        $method->setAccessible(true);
        $this->assertEquals(array('u7', 'foo'), $method->invokeArgs($this->bar, array('bla')));
    }
    public function testGetValuesFromDb()
    {
        $db = new MockPdo();
        $this->bar->setDbConnection($db);
        $reflection = new ReflectionClass('Tracking_Service_Bar');
        $method = $reflection->getMethod('getValuesFromDb');
        $method->setAccessible(true);
        $this->assertEquals(array('foo' => array('bar')), $method->invokeArgs($this->bar, array('bla')));
    }
}