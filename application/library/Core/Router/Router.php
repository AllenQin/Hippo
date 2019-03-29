<?php
namespace App\Library\Core\Router;

use Yaf\Application;
use Yaf\Registry;

class Router
{
    private static $router = [];

    public static function map($routeMap)
    {
        self::$router = $routeMap;
    }

    public static function add($routerName, $uri, $actions, $type = 'rewrite')
    {
        self::$router[] = [$routerName, $uri, $actions, $type];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function __invoke()
    {
        // 转换逻辑
        $result = [];
        foreach (self::$router as $route) {
            list($routeName, $uri, $actions, $type) = $route;
            if (in_array($routeName, self::$router)) {
                continue;
            }

            $actionsArr = explode('@', $actions);
            if (!$actionsArr) {
                throw new Exception('uri is not allow empty!');
            }

            $actionParamCnt = count($actionsArr);
            if ($actionParamCnt == 1) {
                $action = $actions;
            } else if ($actionParamCnt == 2){
                list($controller, $action) = $actionsArr;
            } else {
                list($module, $controller, $action) = $actionsArr;
            }

            $type = $type ?: 'rewrite';
            // @todo other router type
            $result[$routeName] = [
                'type' => $type,
                'match' => $uri,
                'route' => [
                    'module' => isset($module) ? ucfirst($module) : Registry::get('di')->get('config')['application.defaultModule'],
                    'controller' => isset($controller) ? ucfirst($controller) : 'Index',
                    'action' => ucfirst($action),
                ],
            ];
        }

        return $result;
    }
}