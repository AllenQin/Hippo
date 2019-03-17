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
        if (!Registry::get('di')->offsetExists('antiXSS')) {
            Registry::get('di')->set('antiXSS', function(){
                return new AntiXSS();
            });
        }

        /** @var AntiXSS $antiXSS */
        $antiXSS = Registry::get('di')->get('antiXSS');
        return $antiXSS->xss_clean($string);
    }
}
