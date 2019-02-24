<?php
namespace Command;

use Symfony\Component\Console\Input\InputArgument;

class MigrateGenerateCommand extends BaseMigrate
{
    protected function configure()
    {
        $this->setName('migrations:generate')
            ->setDescription('创建数据库迁移脚本');
    }
}
