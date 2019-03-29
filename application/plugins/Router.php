<?php

use Yaf\Application;
use Yaf\Dispatcher;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;


class RouterPlugin extends Plugin_Abstract
{
    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        $moduleName = Dispatcher::getInstance()->getRequest()->getModuleName();
        if ($moduleName == 'Index') {
            Dispatcher::getInstance()->getRequest()->module = Registry::get('di')->get('config')['application.defaultModule'];
        }
    }
}

