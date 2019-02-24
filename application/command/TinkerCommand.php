<?php
namespace Command;

use Psy\Shell;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TinkerCommand extends Command
{
    protected function configure()
    {
        $this->setName('tinker')
            ->setDescription('运行终端控制台');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sh = new Shell();
        $sh->run();
    }
}
