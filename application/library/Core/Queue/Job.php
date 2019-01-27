<?php
namespace App\Library\Core\Queue;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Monolog\Logger;

class Job implements InjectionWareInterface
{
    use InjectionWareTrait;
    protected $logger;

    public function __construct()
    {
        /* @var Logger $this->logger */
        $this->logger = $this->di->get('logger');
    }
}
