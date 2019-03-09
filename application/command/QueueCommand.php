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
            ->setDescription('队列服务 example php bin/assist app:queue biz,order,sms 2')
            ->addArgument('queue', InputArgument::OPTIONAL, '队列服务名称 多个服务名称已英文逗号隔开')
            ->addArgument('count', InputArgument::OPTIONAL, '启动进程数量');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $interval = 1;
        $config = $this->di->get('config')['queue'];
        $logLevel = \Resque_Worker::LOG_NORMAL;

        $queueName = $input->getArgument('queue');
        if (strpos($queueName, ',')) {
            $queueName = explode(',', $queueName);
        }

        $count = $input->getArgument('count');
        if (!$count) {
            $count = 1;
        }

        putenv("REDIS_BACKEND={$config['host']}:{$config['port']}");
        \Resque::setBackend($config['host'] . ':' . $config['port']);

        $this->di->get('logger')->debug('queue start worker params', [$queueName, $count]);
        if ($count > 1) {
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
                } else {
                    // @todo throw error
                }
            }
        } else {
            $worker = new \Resque_Worker($queueName);
            $worker->logLevel = $logLevel;
            $this->di->get('logger')->debug('queue start worker', [$worker]);
            $worker->work($interval);
        }
    }
}

