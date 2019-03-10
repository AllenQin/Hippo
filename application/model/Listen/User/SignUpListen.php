<?php
namespace App\Model\Listen\User;

use App\Library\Core\Event\Listener;
use App\Model\Events\User\UserSignUpEvent;

class SignUpListen extends Listener
{
    public function onSignUp(UserSignUpEvent $event)
    {
        $user = $event->getUser();
        $this->logger->debug('user sign up', [$user]);
    }
}
