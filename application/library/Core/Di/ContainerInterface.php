<?php
namespace App\Library\Core\Di;

Interface ContainerInterface
{
    public function set($name, $service);
    public function get($name);
}



