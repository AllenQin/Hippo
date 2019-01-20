<?php
namespace App\Library\Core\Event;

use App\Library\Core\Di\Container;
use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;

/**
 * Class Listener
 * @property Container $di
 *
 * @package App\Library\Core\Event
 */
class Listener implements InjectionWareInterface
{
    use InjectionWareTrait;
    protected $di;

    public function __construct()
    {
        $this->di = $this->getDi();
    }
}
