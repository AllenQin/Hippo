<?php
namespace App\Models\EventListen\Message;

use App\Library\Core\Event\Listener;
use App\Models\Jobs\MessageJob;
use Goods\OrderModel;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\Event;

class SendListener extends Listener
{
    public function onOrderPlaced(Event $event)
    {
        /* @var OrderModel $order */
        $order = $event->getOrder();

        /* @var Logger $logger */
        $logger = $this->di->get('logger');
        $logger->debug('order placed event send msg', ['order_id' => $order->getOrderId()]);

        /* @var HQueue $queue */
        $queue = $this->di->get('queue');
        $jobId = $queue->enqueue('order', MessageJob::class, ['userPhone' => '13000000000']);
        if (!$jobId) {
            // 补发消息
        }
    }
}
