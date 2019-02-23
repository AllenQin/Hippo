<?php
use App\Models\Listen\Goods\StockListener;
use App\Models\Listen\Message\SendListener;
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
