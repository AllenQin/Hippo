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
        /** @var AntiXSS $antiXss */
        $antiXss = Registry::get('di')->getOrInstance('antiXss', function($c){
            return new AntiXSS();
        });

        return $antiXss->xss_clean($string);
    }
}
