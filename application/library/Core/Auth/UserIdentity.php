<?php
namespace App\Library\Core\Auth;

use App\Library\Core\Cookie\CookieService;
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
     * Login user unique ID
     *
     * @var integer
     */
    private $id;

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

    /** @var  CookieService $cookie */
    private $cookie;

    /**
     * Cookie id
     *
     * @var string
     */
    private $authId;

    /**
     * UserIdentity constructor.
     *
     * @param Container $container
     * @throws \Exception
     */
    public function __construct(Container $container)
    {
        $this->logger = $container['logger'];
        $this->sessionBag = $container['sessionBag'];
        $this->cookie = $container['cookieSrv'];
        $this->authId = md5($container['config']['auth']['id']);

        $this->userData = $this->getUserData();
        if ($this->userData && !isset($this->userData['id'])) {
            throw new \Exception('UserIdentity property userData must contain id field!');
        }

        $this->isGuest = $this->userData ? false : true;
        $this->id = !$this->isGuest ? $this->userData['id'] : 0;
    }

    /**
     * Login user
     *
     * @param UserInterface $user
     * @param int $expired
     * @return mixed
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
        return $this->sessionBag->destroy() && $this->cookie->delete($this->authId);
    }

    /**
     * Get Login user ID
     *
     * @return int|mixed
     */
    public function getUid()
    {
        return $this->id;
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
