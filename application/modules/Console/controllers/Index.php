<?php

use App\Library\Core\Console\Console;

class IndexController extends Console
{
    public function indexAction()
    {
        $this->logger->info('test log', ['content' => 'Hello World']);
        echo 'Hello World' . PHP_EOL;
    }
}
