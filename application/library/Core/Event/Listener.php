<?php
namespace App\Library\Core\Event;

use App\Library\Core\Di\Container;
use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;

/**
 * Class Listener
 *
 * @package App\Library\Core\Event
 */
class Listener implements InjectionWareInterface
{
    use InjectionWareTrait;
}
