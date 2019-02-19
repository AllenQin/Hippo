<?php
namespace Command;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QueueCommand extends Command implements InjectionWareInterface
{
    use InjectionWareTrait;

    protected function configure()
    {
        $this->setName('app:queue')
            ->setDescription('队列服务')
            ->addArgument('queue', InputArgument::OPTIONAL, '队列服务名称')
            ->addArgument('count', InputArgument::OPTIONAL, '启动worker数量');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $queueName = $input->getArgument('queue');
        $count = $input->getArgument('count');
        $config = $this->di->get('config')['queue'];

        $interval = 1;
        $logLevel = \Resque_Worker::LOG_NORMAL;
        putenv("REDIS_BACKEND={$config['host']}:{$config['port']}");
        \Resque::setBackend($config['host'] . ':' . $config['port']);

        for($i = 0; $i < $count; ++$i) {
            $pid = pcntl_fork();
            if($pid == -1) {
                die("Could not fork worker ".$i."\n");
            }

            else if(!$pid) {
                $worker = new \Resque_Worker($queueName);
                $worker->logLevel = $logLevel;
                $this->di->get('logger')->debug('queue start worker', [$worker]);
                $worker->work($interval);
                break;
            }
        }
    }
}

