<?php

use App\Library\Core\Controller;
use App\Services\Event\OrderPlacedEvent;
use GuzzleHttp\Client;
use Goods\OrderModel;
use Symfony\Component\EventDispatcher\EventDispatcher;

class IndexController extends Controller
{
    public function indexAction()
    {
        /* @var $client Client */
        $client = $this->di->get('httpClient');

        $order = new OrderModel(1000);
        $event = new OrderPlacedEvent($order);

        /* @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $this->di->get('eventDispatcher');
        $eventDispatcher->dispatch(OrderPlacedEvent::NAME, $event);

        $this->display('index', ['content' => '']);
    }
}
