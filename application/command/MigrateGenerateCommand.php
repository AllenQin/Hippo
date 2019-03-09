<?php
namespace Command;

use Symfony\Component\Console\Input\InputOption;

class MigrateGenerateCommand extends BaseMigrate
{
    protected function configure()
    {
        $this
            ->setName('migrations:generate')
            ->setAliases(['generate'])
            ->setDescription('创建新的迁移类')
            ->addOption(
                'editor-cmd',
                null,
                InputOption::VALUE_OPTIONAL,
                'Open file with this command upon creation.'
            )
            ->setHelp(<<<EOT
The <info>%command.name%</info> command generates a blank migration class:

    <info>%command.full_name%</info>

You can optionally specify a <comment>--editor-cmd</comment> option to open the generated file in your favorite editor:

    <info>%command.full_name% --editor-cmd=mate</info>
EOT
            );
    }
}

