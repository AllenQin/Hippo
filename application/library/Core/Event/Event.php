<?php
namespace App\Library\Core\Event;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Symfony\Component\EventDispatcher\Event as EventBase;

class Event extends EventBase implements InjectionWareInterface
{
    use InjectionWareTrait;
}
