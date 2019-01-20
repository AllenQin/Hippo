<?php
use App\Services\EventListen\MessageSendListener;
use Symfony\Component\EventDispatcher\Event;

return [
    'order.placed' => [
        function(Event $event) {
            return (new MessageSendListener())->onOrderPlaced($event);
        },
        // ...
    ],
];
