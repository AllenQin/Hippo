<?php
namespace App\Model\Listeners\User;

use App\Library\Core\Event\Listener;
use App\Model\Events\User\UserLogoutEvent;

class LogoutListen extends Listener
{
    public function handle(UserLogoutEvent $event)
    {
        $this->logger->debug('user logout', [$event->getUser()]);
    }
}
