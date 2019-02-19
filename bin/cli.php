<?php
use Yaf\Application;
use Yaf\Request\Simple;

set_time_limit(0);
define('APP_PATH', dirname(__DIR__));

if ($argc == 1) {
    // @todo output the console command
    return false;
}

$contParams = $argv[1];
list($controllerName, $actionName) = explode('/', $contParams);

$params = [];
if ($argc > 2) {
    $paramsArr = array_slice($argv, 2, $argc - 2);
    foreach ($paramsArr as $paramString) {
        if (strpos($paramString, '--') !== 0) {
            continue;
        }
        list($field, $value) = explode('=', substr($paramString, 2, strlen($paramString) - 2));
        $params[$field] = $value ?: '';
    }
}

$app = new Application(APP_PATH . '/conf/application.ini', ini_get('yaf.environ'));
$app->bootstrap()->getDispatcher()->dispatch(new Simple(null, "Console", $controllerName, $actionName, $params));

