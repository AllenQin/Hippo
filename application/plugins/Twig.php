<?php

use App\Library\Core\MVC\TemplateAdapter;
use Yaf\Dispatcher;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class TwigPlugin extends Plugin_Abstract
{
    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        $dispatcher = Dispatcher::getInstance();
        $config = Registry::get('config');
        if (isset($config['twig']['enable']) && $config['twig']['enable']) {
            $dispatcher->disableView();
            $moduleName = $request->getModuleName();
            $viewPath = APP_PATH . '/application/modules/' . $moduleName . '/views/';
            $dispatcher->setView(new TemplateAdapter($viewPath, $config['twig']));
        }
    }
}
