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
        $config = Registry::get('config');
        $dispatcher = Dispatcher::getInstance();
        $moduleName = $request->getModuleName();

        if (isset($config['twig']['enable']) && $config['twig']['enable']
            && in_array($moduleName, explode(',', $config['twig']['modules']))) {

            $dispatcher->disableView();
            $viewPath = APP_PATH . '/application/modules/' . $moduleName . '/views/';
            $dispatcher->setView(new TemplateAdapter($viewPath, $config['twig']));
        }
    }
}
