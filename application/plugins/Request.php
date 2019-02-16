<?php
use Monolog\Logger;
use Yaf\Application;
use Yaf\Plugin_Abstract;
use Yaf\Registry;

class RequestPlugin extends Plugin_Abstract
{
    public function routerStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {

    }

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

        if (Application::app()->environ() == 'develop' && Registry::get('config')['xhprof']['open']) {
            xhprof_enable(XHPROF_FLAGS_MEMORY);
        }
    }

    /**
     * @param Request_Abstract $request
     * @param Response_Abstract $response
     */
    public function dispatchLoopShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        if (Application::app()->environ() == 'develop' && Registry::get('config')['xhprof']['open']) {
            $config = Registry::get('config')['xhprof'];

            $xhprofData = xhprof_disable();
            include_once $config['path'] . '/xhprof_lib/utils/xhprof_lib.php';
            include_once $config['path'] . '/xhprof_lib/utils/xhprof_runs.php';
            $xhprofRuns = new \XHProfRuns_Default();
            $runId = $xhprofRuns->save_run($xhprofData, 'Hippo');

            $url = $config['outer']['domain'] . '/index.php?run=' . $runId . '&source=Hippo';
            /* @var Logger $Logger */
            $Logger = Registry::get('di')->get('logger');
            $Logger->debug('request showdown info', ['xhprof_url' => $url]);
        }
    }
}

