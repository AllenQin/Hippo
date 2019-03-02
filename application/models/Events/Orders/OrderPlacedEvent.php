<?php
namespace App\Models\Events\Orders;

use App\Library\Core\Event\IEvent;
use Symfony\Component\EventDispatcher\Event;

class OrderPlacedEvent extends Event implements IEvent
{
    public function getEventName()
    {
        // TODO: Implement getEventName() method.
    }
}
