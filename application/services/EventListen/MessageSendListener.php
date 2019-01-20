<?php
namespace App\Services\EventListen;

use App\Services\Event\OrderPlacedEvent;
use Goods\OrderModel;

class MessageSendListener
{
    public function onOrderPlaced(OrderPlacedEvent $event)
    {
        /* @var OrderModel $order */
        $order = $event->getOrder();

        echo 'the order number : ' . $order->getOrderId() . PHP_EOL;
    }
}
