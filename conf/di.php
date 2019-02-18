<?php
use App\Library\Core\Cache\Redis;
use App\Library\Core\Database\MySQL;
use App\Library\Core\Queue\HQueue;
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
    'queue' => function($c) {
        $queue = new HQueue($c['config']['queue']);
        return $queue;
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
