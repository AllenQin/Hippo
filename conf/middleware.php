<?php

use App\Model\MiddleWares\VerifryCsrfToken;

return [
    'common' => [
    ],
    'web' => [
        VerifryCsrfToken::class,
    ],
    'admin' => [
        VerifryCsrfToken::class,
    ],
    'web@user@*' => [
    ],
];
