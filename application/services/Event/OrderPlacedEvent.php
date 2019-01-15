<?php
namespace App\Services\Event;

use Goods\OrderModel;
use Symfony\Component\EventDispatcher\Event;

class OrderPlacedEvent extends Event
{
    const NAME = 'order.placed';

    protected $order;

    public function __construct(OrderModel $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }
}
