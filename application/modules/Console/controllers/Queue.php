<?php

use App\Library\Core\Console\Console;

class QueueController extends Console
{
    public function workerAction()
    {
        $queueName = $this->getParams('queue', 'default');
        $count = $this->getParams('count', 1);
        $config = $this->di->get('config')['queue'];

        $interval = 0.5;
        $logLevel = Resque_Worker::LOG_NORMAL;
        putenv("REDIS_BACKEND={$config['host']}:{$config['port']}");
        Resque::setBackend($config['host'] . ':' . $config['port']);

        for($i = 0; $i < $count; ++$i) {
            $pid = pcntl_fork();
            if($pid == -1) {
                die("Could not fork worker ".$i."\n");
            }

            else if(!$pid) {
                $worker = new Resque_Worker($queueName);
                $worker->logLevel = $logLevel;
                $this->di->get('logger')->debug('queue start worker', [$worker]);
                $worker->work($interval);
                break;
            }
        }
    }
}
