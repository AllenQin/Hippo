<?php

use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;

class Bootstrap extends Bootstrap_Abstract
{
    /**
     * 初始化一些配置信息
     */
    public function _initConfig()
    {
    }

    /**
     * 初始化Loader
     */
    public function _initLoader()
    {

    }

    /**
     * 初始化依赖注入services
     */
    public function _initServices()
    {

    }

    /**
     * 初始化全局事件监听
     */
    public function _initListener()
    {
    }

    /**
     * 插件初始化
     *
     * @param Dispatcher $dispatcher
     */
    public function _initPlugin(Dispatcher $dispatcher)
    {
    }

    /**
     * 初始化视图
     *
     * @param Dispatcher $dispatcher
     */
    public function _initView(Dispatcher $dispatcher)
    {
        // 不自动渲染视图
        $dispatcher->autoRender(false);
    }
}
