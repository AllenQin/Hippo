<?php

use App\Library\Core\Console\Console;
use Monolog\Logger;

class IndexController extends Console
{
    public function indexAction()
    {
        /* @var Logger $Logger */
        $Logger = $this->logger;
        $Logger->info('test log', ['content' => 'Hello World']);

        echo 'Hello World' . PHP_EOL;
    }
}
