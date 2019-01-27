<?php
use App\Models\EventListen\Goods\StockListener;
use App\Models\EventListen\Message\SendListener;
use Symfony\Component\EventDispatcher\Event;

return [
    'order.placed' => [
        function(Event $event) {
            return (new StockListener())->onOrderPlaced($event);
        },
        function(Event $event) {
            return (new SendListener())->onOrderPlaced($event);
        },
        // ...
    ],
];
