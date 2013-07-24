TRACKING
<hr>
<pre>
<?php
function AppAutoloader($classname)
{
    $loaded = array();
    if (array_key_exists($classname, $loaded)) {
        require_once $loaded[$classname] . '.php';
    } else {
        if (strpos($classname, '\\')) {
//            $appdir = realpath(APPDIR . '/..');
            $classname = ltrim($classname, '\\');
            $filename = './' . str_replace(array('\\', '_'), '/', $classname);
        } else {
            $filename  = './' . str_replace('_', '/', $classname);
        }
        if (file_exists($filename . '.php')) {
            $loaded[$classname] = $filename;
            require_once $filename . '.php';
        }
    }
}

spl_autoload_register('AppAutoloader');
//var_dump(Tracking_Data::getInstance());
Tracking_Generator::getInstance()->setAgent(1)->setDb(new PDO('mysql:dbname=test;host=127.0.0.1', 'root', ''));
Tracking_Data::getInstance()->hallo = 'foo';
Tracking_Data::getInstance()->setOrderId('123456789')
                            ->setHotelId(555)
                            ->setHotelName('EIN HOTEL')
                            ->setEndDate(time())
                            ->setEmail('test@example.com');
$item = new Tracking_Data_Google_EcommerceItem();
$item->setCategory('NÖNÖ');
Tracking_Data::getInstance()->addGoogleEcommerceItem($item);
$item2 = new Tracking_Data_Google_EcommerceItem();
$item2->setCategory('huhu');
Tracking_Data::getInstance()->addGoogleEcommerceItem($item2);
var_dump(Tracking_Data::getInstance());
//echo Tracking_Data::getInstance()->getOrderId() . PHP_EOL . Tracking_Data::getInstance()->hallo;
//echo '<br>';
//echo Tracking_Generator::getInstance()->generate('TestA') . PHP_EOL;
//echo htmlentities(Tracking_Generator::getInstance()->generate('TestB'));
//echo Tracking_Generator::getInstance()->generateC();
//Tracking_Data::getInstance()->setOrderId('abcde');
echo '<br>';
//echo Tracking_Generator::getInstance()->generate('TestA') . PHP_EOL;
//echo htmlentities(Tracking_Generator::getInstance()->generate('DoubleClick', 'bs2')) . PHP_EOL;
//echo htmlentities(Tracking_Generator::getInstance()->generate('DoubleClick', 'bs3')) . PHP_EOL;
echo htmlentities(Tracking_Generator::getInstance()->generate('Zanox', 'bs3', array('zanoxReview' => 'stepTwo'))) . PHP_EOL;
echo htmlentities(Tracking_Generator::getInstance()->generate('Zanox', 'bs3')) . PHP_EOL;