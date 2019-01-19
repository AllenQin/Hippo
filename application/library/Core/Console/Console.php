<?php
namespace App\Library\Core\Console;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Yaf\Controller_Abstract;
use Yaf\Exception;

class Console extends Controller_Abstract implements InjectionWareInterface
{
    use InjectionWareTrait;
    public $yafAutoRender = false;

    public function init()
    {
        set_exception_handler([$this, 'catchException']);
    }

    public function getParams($name, $default = '')
    {
        return $this->getRequest()->getParam($name, $default);
    }

    private function colorize($msg, $status)
    {
        // @todo use font color
        return $msg;
    }

    public function catchException(Exception $e)
    {
        if ($e instanceof Exception\LoadFailed\Action) {
            echo $this->colorize('not find action', 'FAILURE') . PHP_EOL;
        } else {
            echo $this->colorize($e->getMessage(), 'WARNING') . PHP_EOL;
        }

        exit();
    }
}
