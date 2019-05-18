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

return [
    'userSingUp' => [
        function(App\Model\Events\User\UserSignUpEvent $event) {
            return (new App\Model\Listeners\User\SignUpListen())->onSignUp($event);
        },
    ],
    'userLogout' => [
        function(App\Model\Events\User\UserLogoutEvent $event) {
            return (new App\Model\Listeners\User\LogoutListen())->handle($event);
        },
    ],
    'userLogin' => [
        function(App\Model\Events\User\UserLoginEvent $event) {
            return (new App\Model\Listeners\User\LoginListen())->handle($event);
        },
        function(App\Model\Events\User\UserLoginEvent $event) {
            return (new App\Model\Listeners\Security\CheckLoginSecurityListen())->handle($event);
        }
    ],
];
