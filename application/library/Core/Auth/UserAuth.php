<?php
namespace App\Library\Core\Auth;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use App\Library\Core\Session\SessionBag;

class UserAuth implements InjectionWareInterface
{
    use InjectionWareTrait;

    private $sessionBag = null;

    private $key = 'userIdentity:auth:key';

    public function __construct(SessionBag $sessionBag)
    {
        $this->sessionBag = $sessionBag;
    }

    public function isGuest()
    {
        if (!$this->sessionBag->getSessionId()) {
            return true;
        }

        if (!$this->sessionBag->get($this->key)) {
            return true;
        }
    }

    public function login()
    {

    }
}

