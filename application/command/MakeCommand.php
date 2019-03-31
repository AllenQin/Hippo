<?php
namespace Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommand extends BaseMakeFile
{
    protected function configure()
    {
        $this->setName('make:command')
            ->setDescription('create a command file')
            ->addOption('file', null, InputOption::VALUE_OPTIONAL, 'file name')
            ->addOption('command', null, InputOption::VALUE_OPTIONAL, 'command name')
            ->addOption('make-file', null, InputOption::VALUE_OPTIONAL, 'create file command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getOption('file');
        $command = $input->getOption('command');
        $makeFileFlag = $input->getOption('make-file') ?: false;

        $nameSpace = 'Command';
        $className = ucfirst($fileName) . 'Command';
        $fileName = $className . '.php';

        $this->initNamespace($nameSpace);
        $this->addClass($className);
        if ($makeFileFlag) {
            $this->setExtend('Command\\BaseMakeFile');
        } else {
            $this->setExtend('Symfony\\Component\\Console\\Command\\Command');
        }

        $configureMethodBody = "\$this->setName('{$command}')\n\t->setDescription('undefined command');";
        $this->addMethod('configure', [], $configureMethodBody);

        $executeMethodBody = "\$output->writeln('hello!');";
        $this->addMethod('execute',
            [
                'input' => 'Symfony\\Component\\Console\\Input\\InputInterface',
                'output' => 'Symfony\\Component\\Console\\Output\\OutputInterface',
            ],
            $executeMethodBody
        );

        if ($this->createFile($fileName, $input, $output)) {
            $output->writeln('create success');
        } else {
            $output->writeln('no change');
        }
    }
}
