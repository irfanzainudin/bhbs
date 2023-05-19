<?php

/**
 * Description:	This includes for basic and core configurations.
 * Author:		Joken Villanueva
 * Date Created:	October 27, 2013
 * Revised By:		
 */

// define the core paths
// define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP Pre-defined constants:
// (\ for windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . 'bhbs');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes');

// load config file first
require_once(LIB_PATH . DS . "config.php");

// load basic functions next so that everything after can use them
require_once(LIB_PATH . DS . "functions.php");

// load our class session
require_once(LIB_PATH . DS . "session.php");
require_once(LIB_PATH . DS . "user.php");
require_once(LIB_PATH . DS . "accommodation.php");
require_once(LIB_PATH . DS . "guest.php");
require_once(LIB_PATH . DS . "reserve.php");

// load Core objects
require_once(LIB_PATH . DS . "database.php");

// load database-related classes
