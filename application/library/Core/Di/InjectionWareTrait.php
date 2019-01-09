<?php
namespace App\Library\Core\Di;

trait InjectionWareTrait
{
    public function setDi($di)
    {
        $this->di = $di;
    }

    public function getDi()
    {
        return isset($this->di) ? $this->di : Container::getDefault();
    }

    public function __get($name)
    {
        if ($name == 'di') {
            return $this->di = $this->getDi();
        }

        return $this->di[$name];
    }
}
