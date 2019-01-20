<?php
use Monolog\Logger;
use Yaf\Plugin_Abstract;
use Yaf\Registry;

class RouterPlugin extends Plugin_Abstract
{
    public function routerStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {

    }

    public function routerShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        /* @var Logger $Logger */
        $Logger = Registry::get('di')->get('logger');
        $Logger->debug('request info', [
            'params' => $request->getParams(),
            'module' => $request->getModuleName(),
            'controller' => $request->getControllerName(),
            'action' => $request->getActionName(),
            'time' => microtime(),
        ]);
    }
}

