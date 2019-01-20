<?php
namespace App\Library\Core;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;

/**
 * Class Service
 * @package App\Library
 */
class Service implements InjectionWareInterface
{
    use InjectionWareTrait;

    public function __construct()
    {
        // other things
    }
}