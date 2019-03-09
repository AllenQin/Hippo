<?php
namespace Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateRunCommand extends BaseMigrate
{
    protected function configure()
    {
        $this->setName('migrations:migrate')
            ->setAliases(['migrate'])
            ->setDescription('执行迁移命令')
            ->addOption('--dry-run', null, InputOption::VALUE_OPTIONAL, '显示变更SQL 不执行操作')
            ->addArgument('params', InputArgument::OPTIONAL, '迁移版本');
    }
}
