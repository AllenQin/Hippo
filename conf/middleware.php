<?php

use App\Model\MiddleWares\Auth;
use App\Model\MiddleWares\Guest;

return [
    'common' => [
    ],
    'api' => [
        Auth::class
    ],
    'web@user@signIn' => [
        Guest::class
    ],
    'web@user@signUp' => [
        Guest::class
    ],
];
