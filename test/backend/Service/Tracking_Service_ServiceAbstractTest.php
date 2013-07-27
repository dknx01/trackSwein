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
    public function testGetAgent()
    {
        $mock = $this->getMockForAbstractClass('Tracking_Service_ServiceAbstract');
        $mock->expects($this->any())
             ->method('generate')
             ->will($this->returnValue('Tracked'));
        $this->assertEquals(null, $mock->getAgent());
    }
    public function testSetAgent()
    {
        $mock = $this->getMockForAbstractClass('Tracking_Service_ServiceAbstract');
        $mock->expects($this->any())
             ->method('generate')
             ->will($this->returnValue('Tracked'));
        $mock->setAgent(5);
        $this->assertEquals(5, $mock->getAgent());
    }
    public function testDbValues()
    {
        $mock = $this->getMockForAbstractClass('Tracking_Service_ServiceAbstract');
        $mock->expects($this->any())
             ->method('generate')
             ->will($this->returnValue('Tracked'));
        $mock->setDbValues('bar', array('bla' => 'bla', 'jep' => 'nö'));
        $this->assertEquals(array('bla' => 'bla', 'jep' => 'nö'), $mock->getDbValues('bar'));
    }
    public function testNeededParameters()
    {
        $mock = $this->getMockForAbstractClass('Tracking_Service_ServiceAbstract');
        $mock->expects($this->any())
             ->method('generate')
             ->will($this->returnValue('Tracked'));
        $mock->setNeededParameters('bar', array('u1', 'u5'));
        $this->assertEquals(array('u1', 'u5'), $mock->getNeededParameters('bar'));
    }
    public function testAdditionalParametersWithNull()
    {
        $mock = $this->getMockForAbstractClass('Tracking_Service_ServiceAbstract');
        $mock->expects($this->any())
            ->method('generate')
            ->will($this->returnValue('Tracked'));
        $mock->setAdditionalParameters(null);
        $this->assertInstanceOf('stdClass', $mock->getAdditionalParameters());
    }
    public function testAdditionalParametersWithData()
    {
        $mock = $this->getMockForAbstractClass('Tracking_Service_ServiceAbstract');
        $mock->expects($this->any())
            ->method('generate')
            ->will($this->returnValue('Tracked'));
        $data = new stdClass();
        $data->foo = 'bar';
        $mock->setAdditionalParameters($data);
        $this->assertEquals($data, $mock->getAdditionalParameters());
    }

}