<?php
namespace App\Library\Core\Auth;

use Pimple\Container;
use App\Library\Core\Log\LogWrapper;
use App\Library\Core\Session\SessionBag;

/**
 * Class UserIdentity
 *
 * @package App\Library\Core\Auth
 */
class UserIdentity
{
    /**
     * Whether or not guest
     *
     * @var bool
     */
    public $isGuest;

    /**
     * Login user stage data
     *
     * @var array|mixed
     */
    public $userData;

    /* @var LogWrapper $logger */
    private $logger;

    /* @var SessionBag $sessionBag */
    private $sessionBag;

    /**
     * UserIdentity constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->logger = $container['logger'];
        $this->sessionBag = $container['sessionBag'];
        $this->userData = $this->getUserData();

        $this->isGuest = $this->userData ? false : true;
    }

    /**
     * Login user
     *
     * @param UserInterface $user
     * @param int $expired
     * @return $this|bool
     */
    public function loginUser(UserInterface $user, $expired = 86400)
    {
        if (!$user->getUid()) {
            return false;
        }

        if (!$user->getUserData()) {
            return false;
        }

        $expired += time();
        $this->sessionBag->set('authIdentityValue', json_encode(array_merge($user->getUserData(), ['expired' => $expired])));
        return $this;
    }

    /**
     * Logout user
     *
     * @return mixed
     */
    public function logoutUser()
    {
        return $this->sessionBag->destroy();
    }

    /**
     * Get login user data
     * if the validity period is exceeded return empty array
     *
     * @return array|mixed
     */
    protected function getUserData()
    {
        $identityValue = $this->sessionBag->get('authIdentityValue');
        if (!$identityValue || !$identityValue = json_decode($identityValue, true)) {
            return [];
        }

        return $identityValue['expired'] < time() ? [] : $identityValue;
    }
}
