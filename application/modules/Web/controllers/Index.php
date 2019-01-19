<?php

use App\Library\Core\MVC\Controller;
use App\Services\Event\OrderPlacedEvent;
use Goods\OrderModel;
use Symfony\Component\EventDispatcher\EventDispatcher;

class IndexController extends Controller
{
    public function indexAction()
    {
        $order = new OrderModel(1000);
        $event = new OrderPlacedEvent($order);

        /* @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $this->di->get('eventDispatcher');
        $eventDispatcher->dispatch(OrderPlacedEvent::NAME, $event);

        $this->display('index', ['content' => '']);
    }

    public function sayHelloAction()
    {
        echo 'hello';
        die();
    }
}
