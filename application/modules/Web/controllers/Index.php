<?php

use App\Library\Core\Database\DatabaseInterface;
use App\Library\Core\MVC\Controller;
use App\Library\Core\Queue\HQueue;
use App\Models\Event\OrderPlacedEvent;
use App\Models\Jobs\OrderJob;
use Goods\OrderModel;

class IndexController extends Controller
{
    public function indexAction()
    {
        // Event Demo
        $orderId = $this->getQuery('order_id', 1024);
        $order = new OrderModel($orderId);
        $event = new OrderPlacedEvent($order);

        $eventDispatcher = $this->di->get('eventDispatcher');
        $eventDispatcher->dispatch(OrderPlacedEvent::NAME, $event);

        /* @var DatabaseInterface $db */
        // Database Demo
        /*
        $db = $this->di->get('db');
        $result = $db->find('user', '*');
        */

        /* @var HQueue $queue */
        /*
        $queue = $this->di->get('queue');
        $jobId = $queue->enqueue('order', OrderJob::class, ['order_id' => $orderId]);
        */

        $this->display('index', ['content' => 'Hippo!']);
    }
}
