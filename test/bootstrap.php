<?php
/**
 * just a simple autoloader for the unit tests
 */

/**
 * @param string $classname
 */
function AppAutoloader($classname)
{
    $loaded = array();
    if (array_key_exists($classname, $loaded)) {
        require_once $loaded[$classname] . '.php';
    } else {
        if (strpos($classname, '\\')) {
            $classname = ltrim($classname, '\\');
            $filename = '../src/' . str_replace(array('\\', '_'), '/', $classname);
        } else {
            $filename  = '../src/' . str_replace('_', '/', $classname);
        }
        if (file_exists($filename . '.php')) {
            $loaded[$classname] = $filename;
            require_once $filename . '.php';
        }
    }
}

spl_autoload_register('AppAutoloader');