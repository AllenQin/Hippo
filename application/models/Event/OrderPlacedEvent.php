<?php
namespace App\Models\Event;

use App\Library\Core\Event\IEvent;
use Goods\OrderModel;
use Symfony\Component\EventDispatcher\Event;

class OrderPlacedEvent extends Event implements IEvent
{
    const NAME = 'order.placed';

    protected $order;
    protected $goods;

    public function __construct(OrderModel $order)
    {
        $this->order = $order;

        // 通过订单查询商品
        $this->goods = ['id' => $order->getOrderId()];
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getGoods()
    {
        return $this->goods;
    }

    public function getEventName()
    {
        return self::NAME;
    }
}
