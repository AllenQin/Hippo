<?php
namespace App\Library\Core\MVC;

use Yaf\Exception\LoadFailed\Action;

class Controller extends BaseController
{
    public function init()
    {
        set_exception_handler([$this, 'catchException']);
    }

    public function catchException(\Exception $e)
    {
        if ($e instanceof Action) {
            return false;
        } else {
            return false;
        }
    }
}
