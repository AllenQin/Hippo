<?php
namespace App\Model\Listeners\Security;

use App\Library\Core\Event\Listener;
use App\Model\Events\User\UserLoginEvent;
use App\Model\Jobs\Security\checkLoginIPJob;

class CheckLoginSecurityListen extends Listener
{
    public function handle(UserLoginEvent $event)
    {
        $ip = $this->request->getRequest()->getServer('REMOTE_ADDR');
        $this->di->get('queue')->enqueue('biz', checkLoginIPJob::class, ['ip' => $ip]);

        // @todo other check
    }
}
