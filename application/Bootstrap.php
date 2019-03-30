<?php

use App\Library\Core\Di\Container;
use App\Library\Core\Router\Router;
use Illuminate\Database\Capsule\Manager;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Yaf\Application;
use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;
use Yaf\Loader;
use Yaf\Registry;

class Bootstrap extends Bootstrap_Abstract
{
    private $config;

    /**
     * 加载配置文件
     */
    public function _initConfig()
    {
        // 初始化化配置
        $this->config = Application::app()->getConfig()->toArray();
        Registry::set('config', $this->config);
    }

    /**
     * 自动加载文件
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
     * develop debug
     */
    public function _initDebug()
    {
        if ($this->config['application']['debug'] == true) {
            (new Run())->pushHandler(new PrettyPageHandler())->register();
        }
    }

    /**
     * 初始化预注入容器服务
     */
    public function _initServices()
    {
        if (file_exists(APP_PATH . '/conf/di.php') && $services = require(APP_PATH . '/conf/di.php')) {
            Registry::set('di', new Container($services));
        }
    }

    /**
     * 初始化自定义路由
     *
     * @param Dispatcher $dispatcher
     */
    public function _initRouter(Dispatcher $dispatcher)
    {
        $routerConfig = APP_PATH . '/conf/router.php';
        if (file_exists($routerConfig) && $routerMap = require $routerConfig) {
            if (is_object($routerMap) && $routerMap instanceof Router) {
                $dispatcher->getRouter()->addConfig($routerMap());
            } else if(is_array($routerMap)) {
                $dispatcher->getRouter()->addConfig($routerMap);
            }
        }
    }

    /**
     * 初始化自定义插件
     *
     * @param Dispatcher $dispatcher
     */
    public function _initPlugin(Dispatcher $dispatcher)
    {
        $plugins = [
            new RequestPlugin(),
            new RouterPlugin(),
            new MiddleWarePlugin(),
        ];

        foreach ($plugins as $plugin) {
            $dispatcher->registerPlugin($plugin);
        }
    }

    /**
     * 初始化数据库连接
     */
    public function _initDefaultDbAdapter()
    {
        $capsule = new Manager();
        $capsule->addConnection($this->config['database']);
        $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new Illuminate\Container\Container()));
        $capsule->setAsGlobal();

        $capsule->bootEloquent();
        Registry::get('di')->set('db', $capsule);
        Registry::set('db', $capsule);
        class_alias('\Illuminate\Database\Capsule\Manager', 'DB');
    }

    /**
     * 初始化监听事件
     */
    public function _initListener()
    {
        $listenerFilePath = APP_PATH . '/conf/listener.php';
        if (file_exists($listenerFilePath) && $listener = require($listenerFilePath)) {
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
     * 处理视图展示
     *
     * @param Dispatcher $dispatcher
     */
    public function _initView(Dispatcher $dispatcher)
    {
        $dispatcher->autoRender(false);
    }
}
