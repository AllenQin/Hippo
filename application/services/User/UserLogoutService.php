<?php
namespace App\Services\User;

use App\Model\Events\User\UserLogoutEvent;

/**
 * Class UserLogoutService
 * @package App\Services\User
 */
class UserLogoutService extends UserService
{
    /**
     * Logout user
     *
     * @return mixed
     */
    public function doLogout($uid = 0)
    {
        $uid = $uid ?: $this->userIdentity->getUid();
        if (!$uid) {
            return true;
        }

        $user = $this->userRepository->find($uid);
        $userLogoutEvent = new UserLogoutEvent($user);
        $this->eventDispatcher->dispatch(UserLogoutEvent::getEventName(), $userLogoutEvent);
        return $this->userIdentity->logoutUser();
    }
}

