<?php
namespace App\Models\EventListen\Goods;

use App\Library\Core\Event\Listener;
use Symfony\Component\EventDispatcher\Event;

class StockListener extends Listener
{
    public function onOrderPlaced(Event $event)
    {
        $goods = $event->getGoods();

        $logger = $this->di->get('logger');
        $logger->debug('order placed event deduct', ['goods_id' => $goods['id']]);
    }
}
