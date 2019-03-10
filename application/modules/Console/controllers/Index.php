<?php

use App\Library\Core\Console\Console;
use App\Services\User\UserSignUpService;

class IndexController extends Console
{
    public function indexAction()
    {
        $this->logger->info('test log', ['content' => 'Hello World']);
        echo 'Hello World' . PHP_EOL;
    }
}
