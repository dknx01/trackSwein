<?php
/**
 * 
 * @author dknx01 <e.witthauer@gmail.com>
 * @since 28.07.13 17:19
 * @package
 * 
 */

class Tracking_Service_Bar extends Tracking_Service_ServiceAbstract
{
    public function generate($page = null)
    {
        return 'Tracking' . (string)$page;
    }
}