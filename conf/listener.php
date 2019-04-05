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

use App\Model\Events\User\UserLoginEvent;
use App\Model\Events\User\UserLogoutEvent;
use App\Model\Events\User\UserSignUpEvent;
use App\Model\Listeners\Security\CheckLoginSecurityListen;
use App\Model\Listeners\User\LoginListen;
use App\Model\Listeners\User\LogoutListen;
use App\Model\Listeners\User\SignUpListen;

return [
    'userSingUp' => [
        function(UserSignUpEvent $event) {
            return (new SignUpListen())->onSignUp($event);
        },
    ],
    'userLogout' => [
        function(UserLogoutEvent $event) {
            return (new LogoutListen())->handle($event);
        },
    ],
    'userLogin' => [
        function(UserLoginEvent $event) {
            return (new LoginListen())->handle($event);
        },
        function(UserLoginEvent $event) {
            return (new CheckLoginSecurityListen())->handle($event);
        }
    ],
];
