<?php
/**
 * @author dknx01
 */

/**
 * Class Tracking_GeneratorTest
 */
class Tracking_GeneratorTest extends PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf('Tracking_Generator', Tracking_Generator::getInstance());
    }
    public function testDatabase()
    {
        require_once realpath(__DIR__) . '/../classes/MockPdo.php';
        Tracking_Generator::getInstance()->setDb(new MockPdo());
        $this->assertInstanceOf('PDO', Tracking_Generator::getInstance()->getDb());
    }
    public function testAgent()
    {
        Tracking_Generator::getInstance()->setAgent(5);
        $this->assertEquals(5, Tracking_Generator::getInstance()->getAgent());
    }
    public function testDataObjectName()
    {
        Tracking_Generator::getInstance()->setDataObjectName('TEST_Data');
        $this->assertEquals('TEST_Data', Tracking_Generator::getInstance()->getDataObjectName());
    }
    public function testGenerateNoService()
    {
        try {
            Tracking_Generator::getInstance()->generate('foo');
        } catch (Exception $e)
        {
            $this->assertEquals('Tracking service Foo does not exists.', $e->getMessage());
        }
    }
    public function testGenerateNewDataObject()
    {
        try {
            Tracking_Generator::getInstance()->generate('foo', '', null, 'NewObject');
        } catch (Exception $e)
        {
            $this->assertEquals('NewObject', Tracking_Generator::getInstance()->getDataObjectName());
        }
    }
    public function testGenerateAdditionalParameters()
    {
        try {
            Tracking_Generator::getInstance()->generate('foo', '', array('foo' => 'bar'));
        } catch (Exception $e)
        {
            $this->assertEquals('Tracking service Foo does not exists.', $e->getMessage());
        }
    }
    public function testGenerateNoGenerateFunction()
    {
        $mock = $this->getMock('Tracking_Service_Foo');
        try {
            Tracking_Generator::getInstance()->generate('Foo');
        } catch (Exception $e) {
            $this->assertEquals('Tracking service Foo has no generate function.', $e->getMessage());
        }
    }
    public function testGenerate()
    {
//        $mock = $this->getMock('Tracking_Service_Foo',
//            array('setDataObjectName',
//                'setAgent',
//                'setDbConnection',
//                'setAdditionalParameters',
//                 'generate'));
//        $mock->expects($this->any())
//             ->method('setDataObjectName')
//             ->will($this->returnValue('Tracking_Data'));
//        $mock->expects($this->any())
//             ->method('setAgent')
//             ->will($this->returnValue(1));
//        $mock->expects($this->any())
//             ->method('setDbConnection')
//             ->will($this->returnValue(new MockPdo()));
//        $mock->expects($this->any())
//             ->method('setAdditionalParameters')
//             ->will($this->returnValue(new stdClass()));
//        $mock->expects($this->any())
//             ->method('generate')
//             ->will($this->returnValue('This is the tracking code.'));
//        Tracking_Generator::getInstance()->generate('Foo');
        $this->markTestIncomplete();
    }

}
