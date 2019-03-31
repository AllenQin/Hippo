<?php
namespace Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Yaf\Registry;

class EntityCommand extends BaseMakeFile
{
    protected $path = APP_PATH . '/application/model/Domains/Entity/';

    protected function configure()
    {
        $this->setName('make:entity')
            ->setDescription('create a entity class from database')
            ->addOption('onlyShow', null, InputOption::VALUE_OPTIONAL, 'only output the file content')
            ->addOption('className', null, InputOption::VALUE_OPTIONAL, 'customer the class name')
            ->addOption('hidden', null, InputOption::VALUE_OPTIONAL, 'need hidden fields')
            ->addOption('filterField', null, InputOption::VALUE_OPTIONAL, 'need filter fields')
            ->addOption('table', null, InputOption::VALUE_OPTIONAL, 'table name')
            ->addOption('spaceName', null, InputOption::VALUE_OPTIONAL, 'class space name')
            ->addOption('implement', null, InputOption::VALUE_OPTIONAL, 'implement interface class');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $databaseTable = $input->getOption('table');
        $fileSpace = $input->getOption('spaceName');
        $isDryRun = $input->getOption('onlyShow') ?: false;
        $className = $input->getOption('className') ?: ucfirst($databaseTable);
        $hiddenFields = $input->getOption('hidden') ?: false;
        $filterFields = explode(',', $input->getOption('filterField') ?: '');
        $implement = $input->getOption('implement') ?: false;

        $this->getTableSchema($databaseTable);

        $this->initNamespace($fileSpace);
        $this->addClass($className);
        $this->setExtend('App\Library\Core\MVC\EloquentModel');

        $tableField = $this->getTableSchema($databaseTable);
        foreach ($tableField as $field => $type) {
            $this->class->addComment("@property {$type} {$field}");
        }

        if ($implement) {
            $interfaceClassName = explode(',', $implement);
            foreach ($interfaceClassName as $interface) {
                $this->addImplement($interface);
            }
        }

        $this->class->addProperty('table', $databaseTable)
            ->setVisibility('protected');

        $tableField = array_keys($tableField);
        $fillable = [];

        if ($filterFields) {
            foreach ($tableField as $key => $field) {
                if (in_array($field, $filterFields)) {
                    continue;
                }

                $fillable[] = $field;
            }
        }

        $this->class->addProperty('fillable', $fillable ?: $tableField)
            ->setVisibility('protected');

        if ($hiddenFields) {
            $hiddenFields = explode(',', $hiddenFields);
            $this->class->addProperty('hidden', $hiddenFields)
                ->setVisibility('protected');
        }

        if ($isDryRun) {
            $output->writeln($this->getContent());
        } else {
            if($this->createFile($className . '.php', $input, $output)) {
                $output->writeln('create success');
            } else {
                $output->writeln('no change');
            }
        }

        return true;
    }

    private function addImplement($implementClass)
    {
        $this->class->addImplement($implementClass);
        $this->addUse($implementClass);
    }

    private function getTableSchema($table)
    {
        $field = [];
        $db = Registry::get('db');

        $columns = $db->getConnection()->getSchemaBuilder()->getColumnListing($table);
        foreach ($columns as $column) {
            $field[$column] = $db->getConnection()->getSchemaBuilder()->getColumnType($table, $column);
        }

        return $field;
    }
}