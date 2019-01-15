<?php
use App\Services\EventListen\MessageSendListener;

return [
    'order.placed' => [
        [MessageSendListener::class, 'onOrderPlaced']
    ],
];
