<?php
use App\Library\Core\Database\MySQL;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Yaf\Registry;

return [
    'config' => function($c) {
        return Registry::get('config');
    },
    'db' => function($c) {
        return new MySQL($c['config']['database']);
    },
    'cache' => function($c) {
        // @todo use memcache
    },
    'redis' => function($c) {
        // @todo use redis cache
    },
    'queue' => function($c) {
        // @todo use queue class
    },
    'eventDispatcher' => function($c) {
        return new EventDispatcher();
    },
    'assert' => function($c) {
        // @todo use validators
    },
    'httpClient' => function($c) {
        return new Client();
    },
    'logger' => function($c) {
        $Log = new Logger($c['config']['log']['channel']);
        $Log->pushHandler(new StreamHandler($c['config']['log']['path'] . '/'
            . date($c['config']['log']['file_format']) . '.log', Logger::DEBUG));
        return $Log;
    }
];
