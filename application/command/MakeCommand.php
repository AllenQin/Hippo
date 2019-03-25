<?php
namespace Command;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class MakeCommand extends Command
{
    private $path = APP_PATH . '/application/command/';

    /** @var PhpNamespace $namespace **/
    private $namespace;

    /** @var ClassType $class **/
    private $class;

    private $method;

    protected function configure()
    {
        $this->setName('make:command')
            ->setDescription('create a command file')
            ->addOption('file', null, InputOption::VALUE_OPTIONAL, 'file name')
            ->addOption('command', null, InputOption::VALUE_OPTIONAL, 'command name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getOption('file');
        $command = $input->getOption('command');

        $nameSpace = 'Command';
        $className = ucfirst($fileName) . 'Command';
        $fileName = $className . '.php';

        $this->initNamespace($nameSpace);
        $this->addClass($className);
        $this->setExtend('Symfony\\Component\\Console\\Command\\Command');

        $configureMethodBody = "\$this->setName('{$command}')\n\t->setDescription('new command');";
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

    private function addMethod($method, $params, $methodBody)
    {
        $this->method = $this->class->addMethod($method)
            ->setVisibility('protected')
            ->setBody($methodBody);

        $this->method->addComment(ucfirst($method));
        foreach ($params as $param => $typeHint) {
            $this->addUse($typeHint);
            $this->method->addParameter($param)
                ->setTypeHint($typeHint);

            $paramType = explode('\\', $typeHint);
            $type = array_pop($paramType);
            $this->method->addComment("@param {$type} \${$param}");
        }
    }

    private function getContent()
    {
        return $this->namespace;
    }

    private function createFile($fileName, InputInterface $input, OutputInterface $output)
    {
        $fullPath = $this->path . $fileName;
        if (file_exists($fullPath)) {
            $confirmMsg = '<question>The file ' . $fileName . ' is exists, Are you sure want to rewrite it?</question>(y/N)';
            $question = new ConfirmationQuestion($confirmMsg, false);
            $question->setMaxAttempts(2);
            $helper = $this->getHelper('question');

            if (!$helper->ask($input, $output, $question)) {
                return false;
            }
        }

        $fileObject = fopen($fullPath, "w");
        fwrite($fileObject, "<?php");
        fwrite($fileObject, "\n");
        fwrite($fileObject, $this->getContent());
        fclose($fileObject);

        return true;
    }
}
