<?php

return [
    'config' => function($c) {
        return new Adbar\Dot(Yaf\Registry::get('config'));
    },
    'cache' => function($c) {
        return new App\Library\Core\Cache\Redis($c['config']['redis']);
    },
    'redis' => function($c) {
        return new App\Library\Core\Cache\Redis($c['config']['redis']);
    },
    'queue' => function($c) {
        return new App\Library\Core\Queue\HQueue($c['config']['queue']);
    },
    'eventDispatcher' => function($c) {
        return new Symfony\Component\EventDispatcher\EventDispatcher();
    },
    'assert' => function($c) {
        return new App\Library\Core\Validators\Assert($c);
    },
    'httpClient' => function($c) {
        return new GuzzleHttp\Client();
    },
    'logger' => function($c) {
        return (new App\Library\Core\Log\LogWrapper($c))->getLogInstance();
    },
    'sessionBag' => function($c) {
        return App\Library\Core\Session\SessionBag::getInstance(new App\Library\Core\Session\RedisStorage($c));
    },
    'cookieSrv' => function($c) {
        return new App\Library\Core\Cookie\CookieService($c);
    },
    'jwtSrv' => function($c) {
        return new App\Library\Core\Encrypt\JWTService($c);
    },
    'userRepository' => function($c) {
        return new App\Model\Domains\Repositories\User\UserRepository();
    },
    'userIdentity' => function($c) {
        return new App\Library\Core\Auth\UserIdentity($c);
    },
    'mailSrv' => function($c) {
        // customer send Email class
        return new App\Library\Core\Email\Mail(new App\Library\Core\Email\PHPMailerClient($c['config']['mail']));
    },
    'userSignInSrv' => function($c) {
        return new App\Services\User\UserSignInService($c['userRepository']);
    },
    'userSignUpSrv' => function($c) {
        return new App\Services\User\UserSignUpService($c['userRepository']);
    },
    'userLogoutSrv' => function($c) {
        return new App\Services\User\UserLogoutService($c['userRepository']);
    },
    'verifyCsrfToken' => function($c) {
        return new App\Library\Core\Verify\VerifyCsrfToken($c);
    },
    'request' => function($c) {
        return new App\Library\Core\Request\RequestService($c);
    },
];
