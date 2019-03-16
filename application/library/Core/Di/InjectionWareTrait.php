<?php
namespace App\Library\Core\Di;

use App\Library\Core\Auth\UserIdentity;
use App\Library\Core\Validators\Assert;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class InjectionWareTrait
 *
 * @property Container $di
 * @property Assert $assert
 * @property EventDispatcher eventDispatcher
 * @property Logger $logger
 * @property UserIdentity $userIdentity
 *
 * @package App\Library\Core\Di
 */
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
