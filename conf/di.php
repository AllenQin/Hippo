<?php
use GuzzleHttp\Client;

return [
    'db' => function($c) {
        // @todo use db class
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
    'eventManage' => function($c) {
        // @todo use event manage
    },
    'assert' => function($c) {
        // @todo use validators
    },
    'httpClient' => function($c) {
        // @todo use http client class
        return new Client();
    },
    'log' => function($c) {
        // @todo use log class
    }
];
