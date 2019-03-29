<?php

use App\Library\Core\MiddleWare\MiddleWare;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class MiddleWarePlugin extends Plugin_Abstract
{
    /**
     * This hook will be trigged after the route process finished, this hook is usually used for login check.
     *
     * @link http://www.php.net/manual/en/yaf-plugin-abstract.routershutdown.php
     *
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     *
     * @return bool true
     */
    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        $config = APP_PATH . '/conf/middleware.php';
        if (file_exists($config) && $middleWareClass = require $config) {
            $middleWareClass = $this->filterMiddleWare($middleWareClass, $request, $response);
            if (!$middleWareClass) {
                return true;
            }

            $middleWare = new MiddleWare();
            foreach ($middleWareClass as $callback) {
                $middleWare->addMiddleWare($callback);
            }

            $middleWare->run($request);
        }
    }

    private function filterMiddleWare($middleWareClasses, Request_Abstract $request, Response_Abstract $response)
    {
        $middleWareClasses = array_change_key_case($middleWareClasses, CASE_LOWER);
        $moduleName = strtolower($request->getModuleName());
        $controllerName = strtolower($request->getControllerName());
        $actionName = strtolower($request->getActionName());

        $commonMiddleWare = isset($middleWareClasses['common']) ? $middleWareClasses['common'] : [];
        $moduleMiddleWare = isset($middleWareClasses[$moduleName]) ? $middleWareClasses[$moduleName] : [];

        $uriName = $moduleName . '@' . $controllerName . '@' . $actionName;
        $uriMiddleWare = isset($middleWareClasses[$uriName]) ? $middleWareClasses[$uriName] : [];

        return array_merge($commonMiddleWare, $moduleMiddleWare, $uriMiddleWare);
    }
}
