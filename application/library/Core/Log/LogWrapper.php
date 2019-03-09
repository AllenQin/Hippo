<?php
namespace App\Library\Core\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogWrapper
{
    private $log;

    public function __construct($c)
    {
        $this->log = new Logger($c['config']['log']['channel']);
        $this->pushHandler($c);
    }

    public function pushHandler($c)
    {
        $this->log->pushHandler(new StreamHandler($c['config']['log']['path'] . '/' . date($c['config']['log']['file_format']) . '.log', Logger::DEBUG));
    }

    public function getLogInstance()
    {
        return $this->log;
    }
}