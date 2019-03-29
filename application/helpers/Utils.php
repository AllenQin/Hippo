<?php
namespace App\Helpers;

use voku\helper\AntiXSS;
use Yaf\Registry;

/**
 * Class Utils
 *
 * Common Tools Class
 * @package App\Helpers
 */
class Utils
{
    /**
     * Filter XSS content
     *
     * @param $string
     * @return mixed
     */
    public static function removeXss($string)
    {
        /** @var AntiXSS $antiXss **/
        $antiXss = Registry::get('di')->getOrInstance('antiXss', function($c){
            return new AntiXSS();
        });

        return $antiXss->xss_clean($string);
    }

    /**
     * Redirect url
     *
     * @param $uri
     * @param array $params
     */
    public static function redirect($uri, $params = [])
    {
        if (is_array($uri)) {
            $uri =  '/' . implode('/', $uri);
        }

        if ($params) {
            header('HTTP/1.1 301 Moved Permanently');
            $uri .= '?' . http_build_query($params);
        }

        header('Location: ' . $uri);
        exit();
    }
}
