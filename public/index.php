<?php
use Yaf\Application;
define('APP_PATH', dirname(__DIR__));

$app = new Application(APP_PATH . '/conf/application.ini', ini_get('yaf.environ'));
$app->bootstrap()->run();
