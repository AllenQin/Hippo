<?php
namespace App\Model\Events\User;
use App\Library\Core\Event\Event;
use App\Library\Core\Event\IEvent;
use App\Model\Domains\Entity\User;

class UserSignUpEvent extends Event implements IEvent
{
    private $_user;

    public static function getEventName()
    {
        return 'user.SingUp';
    }

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public function getUser()
    {
        return $this->_user;
    }
}

