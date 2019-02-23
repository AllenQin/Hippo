<?php
namespace Command;

use Symfony\Component\Console\Input\InputArgument;

class MigrateRunCommand extends BaseMigrate
{
    protected function configure()
    {
        $this->setName('migrations:migrate')
            ->setDescription('执行迁移命令')
            ->addArgument('params', InputArgument::OPTIONAL, '迁移版本');
    }
}
