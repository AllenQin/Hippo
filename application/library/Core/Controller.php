<?php
namespace App\Library\Core;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Yaf\Controller_Abstract;
use Yaf\Exception;

class Controller extends Controller_Abstract implements InjectionWareInterface
{
    use InjectionWareTrait;
    public $yafAutoRender = false;

    public function init()
    {
    }
}
