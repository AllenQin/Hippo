<?php

use App\Library\Core\Console\Console;
use App\Model\User;

class IndexController extends Console
{
    public function indexAction()
    {
        $this->logger->info('test log', ['content' => 'Hello World']);
        echo 'Hello World' . PHP_EOL;
    }

    public function addUserAction()
    {
        $user = User::create([
            'username' => '1300000000',
            'nickname' => 'allenqin',
            'password' => md5(time()),
            'token' => md5(microtime(true)),
        ]);

        echo $user . PHP_EOL;
    }
}
