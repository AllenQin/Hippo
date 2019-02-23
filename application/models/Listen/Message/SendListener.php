<?php
namespace App\Models\Listen\Message;

use App\Library\Core\Event\Listener;
use App\Models\Jobs\MessageJob;
use Entity\OrderModel;
use Symfony\Component\EventDispatcher\Event;

class SendListener extends Listener
{
    public function onOrderPlaced(Event $event)
    {
        /* @var OrderModel $order */
        $order = $event->getOrder();

        $logger = $this->di->get('logger');
        $logger->debug('order placed event send msg', ['order_id' => $order->getOrderId()]);

        $queue = $this->di->get('queue');

        $msgBody = [
            'phone' => '13000000000',
            'content' => '订单已发货',
        ];
        $jobId = $queue->enqueue('order', MessageJob::class, $msgBody);
        if (!$jobId) {
            // 补发消息
        }
    }
}
