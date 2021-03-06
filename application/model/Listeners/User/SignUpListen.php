<?php
namespace App\Model\Listeners\User;

use App\Library\Core\Event\Listener;
use App\Model\Events\User\UserSignUpEvent;

class SignUpListen extends Listener
{
    public function onSignUp(UserSignUpEvent $event)
    {
        $this->logger->debug('user sign up', [$event->getUser()]);
    }
}
