<?php
namespace Command;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\ClassType;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

use Symfony\Component\Console\Command\Command;

class BaseMakeFile extends Command
{
    protected $path = APP_PATH . '/application/command/';

    /** @var PhpFile $file **/
    protected $file;

    /** @var PhpNamespace $namespace **/
    protected $namespace;

    /** @var ClassType $class **/
    protected $class;

    protected $method;

    protected function initNamespace($namespace)
    {
        $this->file = new PhpFile();
        $this->namespace = $this->file->addNamespace($namespace);
    }

    protected function addUse($fullClass)
    {
        if ($fullClass != 'BaseMakeFile') {
            $this->namespace->addUse($fullClass);
        }
    }

    protected function addClass($name)
    {
        $this->class = $this->namespace->addClass($name);
        $this->class->addComment('Class ' . $name);
        $this->class->addComment('');
    }

    protected function setExtend($parentClass)
    {
        $this->class->addExtend($parentClass);
        $this->addUse($parentClass);
    }

    protected function addMethod($method, $params, $methodBody)
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

    protected function getContent()
    {
        return $this->file;
    }

    protected function createFile($fileName, InputInterface $input, OutputInterface $output)
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
        fwrite($fileObject, $this->getContent());
        fclose($fileObject);

        return true;
    }
}
