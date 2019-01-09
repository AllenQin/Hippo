<?php

use Yaf\Application;
use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;
use Yaf\Loader;
use Yaf\Registry;

class Bootstrap extends Bootstrap_Abstract
{
    public function _initConfig()
    {
        // 初始化化配置
        $config = Application::app()->getConfig()->toArray();
        Registry::set('config', $config);
    }

    public function _initLoader()
    {
        $loader = Loader::getInstance();
        $autoload = APP_PATH . '/vendor/autoload.php';
        if (file_exists($autoload)) {
            $loader->import($autoload);
        }
    }

    public function _initServices()
    {
    }

    public function _initListener()
    {
    }

    public function _initPlugin(Dispatcher $dispatcher)
    {
    }

    public function _initView(Dispatcher $dispatcher)
    {
        $dispatcher->autoRender(false);
    }
}
