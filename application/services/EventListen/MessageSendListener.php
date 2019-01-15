<?php
namespace App\Services\EventListen;

use Goods\OrderModel;
use Symfony\Component\EventDispatcher\Event;

class MessageSendListener
{
    public function onOrderPlaced(Event $event)
    {
        /* @var OrderModel $order */
        $order = $event->getOrder();

        echo '通知订单:' . $order->getOrderId() . PHP_EOL;
    }
}
