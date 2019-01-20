<?php

use App\Library\Core\Database\DatabaseInterface;
use App\Library\Core\MVC\Controller;
use App\Services\Event\OrderPlacedEvent;
use Goods\OrderModel;

class IndexController extends Controller
{
    public function indexAction()
    {
        /*
        // Event Demo
        $orderId = $this->getQuery('order_id', 1024);
        $order = new OrderModel($orderId);
        $event = new OrderPlacedEvent($order);

        $eventDispatcher = $this->di->get('eventDispatcher');
        $eventDispatcher->dispatch(OrderPlacedEvent::NAME, $event);
        */

        /* @var DatabaseInterface $db */
        /*
        // Database Demo
        $db = $this->di->get('db');
        $result = $db->find('user', '*');
        */

        $this->display('index', ['content' => 'Hippo!']);
    }
}
