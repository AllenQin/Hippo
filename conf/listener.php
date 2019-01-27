<?php
use App\Models\EventListen\Goods\StockListener;
use App\Models\EventListen\MessageSendListener;
use Symfony\Component\EventDispatcher\Event;

return [
    'order.placed' => [
        function(Event $event) {
            return (new StockListener())->onOrderPlaced($event);
        },
        function(Event $event) {
            return (new MessageSendListener())->onOrderPlaced($event);
        },
        // ...
    ],
];
