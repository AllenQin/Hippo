<?php

use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;

class Bootstrap extends Bootstrap_Abstract
{
    public function _initConfig()
    {
    }

    public function _initLoader()
    {
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
        // 不自动渲染视图
        $dispatcher->autoRender(false);
    }
}
