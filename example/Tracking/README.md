A danymic tracking library

Usage
=====

Fill the data object with the data you want to track. Your can use the Tracking_Data object or create an own object wiich must extends this object.

Track_Data::getInstance->setHotelId(123456);

To track the data you can ether create a service class in the folder Tracking/Service or an own class which is called in the Generator class.
If you create a service class, this class should must extends Tracking_Service_ServiceAbstract.

The generator will try to run run the Service-generate function for tracking. Normally this class will return the string for the tracking.
If you want to use an other class you can create your own generate function in the generator class e.g. generateABC().

The generator generate function needs an identifier (page).

Database tables usage
=====================

If you want to use the automatically tracking configuration or the static values from the database, the generator needs a database connection.
Tracking_Generator:.getInstance()->setDb($db);

This database provides a table for all needed parameter for a tracking service on a page. These parameters will be shown to you with the ServiceAbstract->_getNeededParamsFromDb($page) function.

The table values can bee reached via ServiceAbstract->_getValuesFromDb($page). There can be more than one value for one parameter at one page. So the first/only value will be $values['PARAMETER'][0].

Tracking_Generator::getInstance()->generate('Zanox', 'bs3');
Tracking_Generator::getInstance()->generateABC();

There can be additional data injected to the generate function:
Tracking_Generator::getInstance()->generate('Zanox', 'bs3', array('zanoxReview' => 'stepTwo'));
