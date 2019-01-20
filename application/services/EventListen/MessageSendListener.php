<?php
namespace App\Services\EventListen;

use App\Library\Core\Event\Listener;
use Goods\OrderModel;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\Event;

class MessageSendListener extends Listener
{
    public function onOrderPlaced(Event $event)
    {
        /* @var OrderModel $order */
        $order = $event->getOrder();

        /* @var Logger $logger */
        $logger = $this->di->get('logger');
        $logger->debug('order placed event', ['order_id' => $order->getOrderId()]);
    }
}
