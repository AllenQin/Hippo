<?php

use App\Library\Core\Di\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Yaf\Application;
use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;
use Yaf\Loader;
use Yaf\Registry;
use Yaf\Route\Rewrite;

class Bootstrap extends Bootstrap_Abstract
{
    /**
     * 加载配置文件
     */
    public function _initConfig()
    {
        // 初始化化配置
        $config = Application::app()->getConfig()->toArray();
        Registry::set('config', $config);
    }

    /**
     * 引入自动加载文件
     */
    public function _initLoader()
    {
        $loader = Loader::getInstance();
        $autoload = APP_PATH . '/vendor/autoload.php';
        if (file_exists($autoload)) {
            $loader->import($autoload);
        }
    }

    /**
     * 加载预注入容器的服务
     */
    public function _initServices()
    {
        if (file_exists(APP_PATH . '/conf/di.php') && $services = require(APP_PATH . '/conf/di.php')) {
            Registry::set('di', new Container($services));
        }
    }

    /**
     * 加载监听事件
     */
    public function _initListener()
    {
        $listenerFilePath = APP_PATH . '/conf/listener.php';
        if (file_exists($listenerFilePath) && $listener = require($listenerFilePath)) {
            /* @var EventDispatcher $eventDispatcher */
            $eventDispatcher = Registry::get('di')->get('eventDispatcher');
            foreach ($listener as $eventName => $value) {
                if (is_array($value)) {
                    foreach ($value as $listen) {
                        $eventDispatcher->addListener($eventName, $listen);
                    }
                } else {
                    $eventDispatcher->addListener($eventName, $value);
                }
            }
        }
    }

    /**
     * 加载自定义路由
     *
     * @param Dispatcher $dispatcher
     */
    public function _initRouter(Dispatcher $dispatcher)
    {
        if (file_exists(APP_PATH . '/conf/router.php') && $routerContent = require(APP_PATH . '/conf/router.php')) {
            $router = $dispatcher->getRouter();
            $router->addConfig($routerContent);
        }
    }

    /**
     * 加载自定义插件
     *
     * @param Dispatcher $dispatcher
     */
    public function _initPlugin(Dispatcher $dispatcher)
    {
        $plugins = [
            new RouterPlugin(),
        ];

        foreach ($plugins as $plugin) {
            $dispatcher->registerPlugin($plugin);
        }
    }

    /**
     * 处理视图展示
     *
     * @param Dispatcher $dispatcher
     */
    public function _initView(Dispatcher $dispatcher)
    {
        $dispatcher->autoRender(false);
    }
}
