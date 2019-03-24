<?php
namespace Command;

use App\Library\Core\Di\InjectionWareTrait;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Yaf\Registry;

class EntityCommand extends Command
{
    use InjectionWareTrait;

    /** @var PhpNamespace $namespace **/
    private $namespace;

    /** @var ClassType $class **/
    private $class;

    private $method;

    protected function configure()
    {
        $this->setName('make:entity')
            ->setDescription('create a entity class from database')
            ->addOption('dry-run', null, InputOption::VALUE_OPTIONAL, 'only output the file content')
            ->addOption('className', null, InputOption::VALUE_OPTIONAL, 'customer the class name')
            ->addArgument('table', InputArgument::OPTIONAL, 'table name')
            ->addArgument('space', InputArgument::OPTIONAL, 'file space');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $databaseTable = $input->getArgument('table');
        $fileSpace = $input->getArgument('space');
        $isDryRun = $input->getOption('dry-run') ?: false;
        $name = ucfirst($databaseTable);

        $this->getTableSchema($databaseTable);

        $this->initNamespace($fileSpace);
        $this->addClass($name);
        $this->setExtend('App\Library\Core\MVC\EloquentModel');

        // @todo find table field
        $tableField = $this->getTableSchema($databaseTable);
        foreach ($tableField as $field => $type) {
            $this->class->addComment("@property {$type} {$field}");
        }

        $this->class->addProperty('table', $databaseTable)
            ->setVisibility('protected');

        // @todo find table field
        $this->class->addProperty('fillable', array_keys($tableField))
            ->setVisibility('protected');

        if ($isDryRun) {
            $output->writeln($this->getContent());
        } else {
            $this->createFile($name);
            $output->writeln('create success');
        }

        return true;
    }

    private function initNamespace($namespace)
    {
        $this->namespace = new PhpNamespace($namespace);
    }

    private function addUse($fullClass)
    {
        $this->namespace->addUse($fullClass);
    }

    private function addClass($name)
    {
        $this->class = $this->namespace->addClass($name);
        $this->class->addComment('Class ' . $name);
        $this->class->addComment('');
    }

    private function setExtend($parentClass)
    {
        $this->class->addExtend($parentClass);
        $this->addUse($parentClass);
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

    private function getContent()
    {
        return $this->namespace;
    }

    private function createFile($name)
    {
        $fullPath = APP_PATH . '/application/model/Domains/Entity/' . $name . '.php';
        $fileObject = fopen($fullPath, "w");

        fwrite($fileObject, "<?php");
        fwrite($fileObject, "\n");
        fwrite($fileObject, $this->getContent());
        fclose($fileObject);

        return true;
    }
}