<?php

/**
 * 绑定全局监听事件
 *
 *  'order.placed' => [
 *      function(Event $event) {
 *          return (new StockListener())->onOrderPlaced($event);
 *      },
 *      function(Event $event) {
 *          return (new SendListener())->onOrderPlaced($event);
 *      },
 *      // ...
 *  ],
 */
use App\Model\Events\User\UserSignUpEvent;
use App\Model\Listen\User\SignUpListen;

return [
    'user.SingUp' => [
        function(UserSignUpEvent $event) {
            return (new SignUpListen())->onSignUp($event);
        },
    ]
];
