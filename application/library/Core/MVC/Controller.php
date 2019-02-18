<?php
namespace App\Library\Core\MVC;

use Yaf\Application;
use Yaf\Exception\LoadFailed\Action;

class Controller extends BaseController
{
    public function init()
    {
        if ($this->config['application']['debug'] === false) {
            set_exception_handler([$this, 'catchException']);
        }
    }

    public function catchException($e)
    {
        if ($e instanceof Action) {
            // not find action

        } else {
            // @todo log
        }

        die();
    }
}
