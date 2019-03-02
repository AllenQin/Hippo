<?php
namespace App\Models\Listen\Orders;

use App\Library\Core\Event\Listener;
use App\Models\Events\Orders\OrderPayEvent;
use App\Models\Events\Orders\OrderPlacedEvent;

class StockListener extends Listener implements IOrderListener
{
    /**
     * order pay event
     *
     * @param OrderPayEvent $orderPayEvent
     * @return mixed
     */
    public function onOrderPay(OrderPayEvent $orderPayEvent)
    {
        // TODO: Implement onOrderPay() method.
    }

    /**
     * order placed event
     *
     * @param OrderPlacedEvent $orderPlacedEvent
     * @return mixed
     */
    public function onOrderPlaced(OrderPlacedEvent $orderPlacedEvent)
    {
        // TODO: Implement onOrderPlaced() method.
    }

}
