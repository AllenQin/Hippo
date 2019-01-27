<?php
namespace App\Library\Core\MVC;

use Yaf\Exception\LoadFailed\Action;

class Controller extends BaseController
{
    public function init()
    {
        set_exception_handler([$this, 'catchException']);
    }

    public function catchException($e)
    {
        if ($e instanceof \Exception || $e instanceof \Error) {
            print_r($e);
        } else {
            // @todo log
        }

        die();
    }
}
