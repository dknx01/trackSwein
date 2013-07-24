<?php
/**
 * @author dknx01
 */

/**
 * Class Tracking_DataTest
 */
class Tracking_DataTest extends PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf('Tracking_Data', Tracking_Data::getInstance());
    }
    public function testSet()
    {
        Tracking_Data::getInstance()->foo = 'bar';
        $this->assertEquals('bar', Tracking_Data::getInstance()->foo);
    }
    public function testUndefinedProperty()
    {
        try {
            Tracking_Data::getInstance()->bla;
        } catch (Exception $e) {
            $this->assertEquals('Tracking property bla does not exists.', $e->getMessage());
        }
    }
    public function testSetIdIndirect()
    {
        Tracking_Data::getInstance()->id = 5;
        $this->assertEquals(5, Tracking_Data::getInstance()->id);
    }
    public function testSetId()
    {
        Tracking_Data::getInstance()->setId(9);
        $this->assertEquals(9, Tracking_Data::getInstance()->getId());
    }
    public function testGetName()
    {
        Tracking_Data::getInstance()->setName('blabla');
        $this->assertEquals('blabla', Tracking_Data::getInstance()->getName());
    }
    public function testAdditionalData()
    {
        Tracking_Data::getInstance()->setAdditionalData(new stdClass());
        $this->assertInstanceOf('stdClass', Tracking_Data::getInstance()->getAdditionalData());
    }
}
