<?php
namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServerCommand extends Command
{
    protected function configure()
    {
        $this->setName('server')
            ->setDescription('运行内置服务器');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo '访问地址: http://localhost:8001' . PHP_EOL;
        $shellResponse = exec('php -S localhost:8001 -t ' . APP_PATH . '/public');
        return true;
    }
}