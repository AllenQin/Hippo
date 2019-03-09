<?php
namespace Command;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DelayQueueCommand extends Command implements InjectionWareInterface
{
    use InjectionWareTrait;

    protected function configure()
    {
        $this->setName('app:delay_queue')
            ->setDescription('延迟队列服务');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $interval = 1;
        $config = $this->di->get('config')['queue'];

        putenv("REDIS_BACKEND={$config['host']}:{$config['port']}");
        \Resque::setBackend($config['host'] . ':' . $config['port']);

        // delay queue worker
        $delayWorker = new \ResqueScheduler_Worker();
        $delayWorker->logLevel = \ResqueScheduler_Worker::LOG_NORMAL;
        $this->di->get('logger')->debug('queue start delay worker', [$delayWorker]);
        $delayWorker->work($interval);
    }
}

