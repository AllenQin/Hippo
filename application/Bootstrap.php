<?php
/**
 * @name Bootstrap
 * @desc   所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see    http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和声明的次序相同
 */

use Core\Di\Container;
use Yaf\Bootstrap_Abstract;
use Yaf\Registry;
use Yaf\Loader;
use Yaf\Dispatcher;
use Yaf\Application;

class Bootstrap extends Bootstrap_Abstract
{
    /**
     * 初始化一些配置信息
     */
    public function _initConfig()
    {
        $config = Application::app()->getConfig()->toArray();

        if (empty($_SERVER['HTTP_X_REQUEST_ID'])) {
            $_SERVER['HTTP_X_REQUEST_ID'] = uniqid();
        }

        Registry::set('config', $config);
    }

    /**
     * 初始化Loader
     */
    public function _initLoader()
    {
        $loader = Loader::getInstance();

        $autoload = APP_ROOT . '/vendor/autoload.php';
        if (file_exists($autoload)) {
            $loader->import($autoload);
        }
    }

    /**
     * 初始化依赖注入services
     */
    public function _initServices()
    {
        $services = [];
        if (file_exists($basicService = APP_CONFIG_PATH . '/di.php') && is_readable($basicService)) {
            $services = require $basicService;
        }

        $env = Application::app()->environ();
        if (file_exists($envService = APP_CONFIG_PATH . '/' . $env . '/di.php') && is_readable($envService)) {
            $services = array_merge($services, require $envService);
        }

        Registry::set('di', new Container($services));
    }

    /**
     * 初始化全局事件监听
     */
    public function _initListener()
    {
        $listeners = [];
        if (file_exists($basicListener = APP_CONFIG_PATH . '/listener.php')) {
            $listeners = require $basicListener;
        }

        $env = Application::app()->environ();
        if (file_exists($envListener = APP_CONFIG_PATH . '/' . $env . '/listener.php') && is_readable($envListener)) {
            $listeners = array_merge($listeners, require $envListener);
        }

        $em = Registry::get('di')->get('eventsManager');
        foreach ($listeners as $event => $handler) {
            if (is_array($handler)) {
                foreach ($handler as $h) {
                    $em->attach($event, $h);
                }
            } else {
                $em->attach($event, $handler);
            }
        }
    }

    /**
     * 插件初始化
     *
     * @param Dispatcher $dispatcher
     */
    public function _initPlugin(Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new LoggingRequestPlugin());
        $dispatcher->registerPlugin(new ModuleBootstrapPlugin());
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
