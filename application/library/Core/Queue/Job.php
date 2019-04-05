<?php
namespace App\Library\Core\Queue;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;

class Job implements InjectionWareInterface
{
    use InjectionWareTrait;

    public function getArguments()
    {
        return $this->args;
    }

    public function getArgument($name, $default = '')
    {
        return isset($this->args[$name]) ? $this->args[$name] : $default;
    }
}
