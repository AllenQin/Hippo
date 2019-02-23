<?php
namespace Command;

class MigrateRunCommand extends BaseMigrate
{
    protected function configure()
    {
        $this->setName('migrations:migrate')
            ->setDescription('执行迁移命令');
    }
}
