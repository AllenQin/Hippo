<?php
use Monolog\Logger;
use Yaf\Plugin_Abstract;
use Yaf\Registry;

class RequestPlugin extends Plugin_Abstract
{
    public function routerStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {

    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     */
    public function routerShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        /* @var Logger $Logger */
        $Logger = Registry::get('di')->get('logger');
        $Logger->debug('request showdown info', [
            'params' => $request->getParams(),
            'module' => $request->getModuleName(),
            'controller' => $request->getControllerName(),
            'action' => $request->getActionName(),
            'time' => microtime(),
        ]);
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     */
    public function dispatchLoopShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {

    }
}

