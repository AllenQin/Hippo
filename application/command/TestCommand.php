<?php
namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected function configure()
    {
        $this->setName('app:test')
            ->setDescription('示例脚本')
            ->addArgument('param1', InputArgument::OPTIONAL, '参数1')
            ->addArgument('param2', InputArgument::OPTIONAL, '参数2');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        print_r($input->getArguments());
    }
}