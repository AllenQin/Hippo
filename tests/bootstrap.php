<?php
use Yaf\Application;
use Yaf\Registry;

define("APP_PATH", realpath(dirname(__FILE__) . '/../'));
$application = new Application(APP_PATH . '/conf/application.ini');
$application->bootstrap();
Registry::set('application', $application);
