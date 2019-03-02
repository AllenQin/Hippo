<?php
namespace App\Models\Listen\Orders;

use App\Models\Events\Orders\OrderPayEvent;
use App\Models\Events\Orders\OrderPlacedEvent;

interface IOrderListener
{
    /**
     * order pay event
     *
     * @param OrderPayEvent $orderPayEvent
     * @return mixed
     */
    public function onOrderPay(OrderPayEvent $orderPayEvent);

    /**
     * order placed event
     *
     * @param OrderPlacedEvent $orderPlacedEvent
     * @return mixed
     */
    public function onOrderPlaced(OrderPlacedEvent $orderPlacedEvent);
}
