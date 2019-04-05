<?php
namespace App\Model\Listeners\User;

use App\Library\Core\Event\Listener;
use App\Library\Core\Request\RequestService;
use App\Model\Events\User\UserLoginEvent;

/**
 * Class LoginListen
 *
 * @property RequestService $request
 *
 * @package App\Model\Listeners\User
 */
class LoginListen extends Listener
{
    public function handle(UserLoginEvent $event)
    {
        $this->logger->debug('user login', [$event->getUser()]);
    }
}
