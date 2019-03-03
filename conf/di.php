<?php
use App\Library\Core\Cache\Redis;
use App\Library\Core\Encrypt\JWTService;
use App\Library\Core\Queue\HQueue;
use App\Library\Core\Session\RedisStorage;
use App\Library\Core\Session\SessionBag;
use App\Library\Core\Validators\Assert;
use App\Models\Domains\Repositories\User\UserRepository;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Yaf\Registry;

return [
    'config' => function($c) {
        return Registry::get('config');
    },
    'cache' => function($c) {
        return new Redis($c['config']['redis']);
    },
    'redis' => function($c) {
        return new Redis($c['config']['redis']);
    },
    'queue' => function($c) {
        return new HQueue($c['config']['queue']);
    },
    'eventDispatcher' => function($c) {
        return new EventDispatcher();
    },
    'assert' => function($c) {
        return new Assert($c);
    },
    'httpClient' => function($c) {
        return new Client();
    },
    'logger' => function($c) {
        $Log = new Logger($c['config']['log']['channel']);
        $Log->pushHandler(new StreamHandler($c['config']['log']['path'] . '/'
            . date($c['config']['log']['file_format']) . '.log', Logger::DEBUG));
        return $Log;
    },
    'sessionBag' => function($c) {
        return SessionBag::getInstance(new RedisStorage($c));
    },
    'cookieSrv' => function($c) {
        return new App\Library\Core\Cookie\CookieService($c);
    },
    'jwtSrv' => function($c) {
        return new JWTService($c);
    },
    'userRepository' => function($c) {
        return new UserRepository(new UserModel());
    }
];
