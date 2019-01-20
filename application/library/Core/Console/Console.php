<?php
namespace App\Library\Core\Console;

use App\Library\Core\MVC\BaseController;
use Yaf\Exception\LoadFailed\Action;

/**
 * Class Console
 *
 * @package App\Library\Core\Console
 */
class Console extends BaseController
{
    public function init()
    {
        set_exception_handler([$this, 'catchException']);
    }

    private function colorize($msg, $status)
    {
        // @todo use font color
        return $msg;
    }

    public function catchException(\Exception $e)
    {
        if ($e instanceof Action) {
            echo $this->colorize('not find action', 'FAILURE') . PHP_EOL;
        } else {
            echo $this->colorize($e->getMessage(), 'WARNING') . PHP_EOL;
        }

        exit();
    }
}
