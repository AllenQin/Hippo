<?php
namespace App\Library\Core\Verify;

use App\Library\Core\Session\SessionBag;

/**
 * Class VerifyCsrfToken
 *
 * @package App\Library\Core\Verify
 */
class VerifyCsrfToken
{
    /**
     * The CSRF Token key
     */
    const TOKEN_KEY = 'user_csrf_token';

    /**
     * User Session Object
     *
     * @var SessionBag
     */
    private $sessionBag;

    /**
     * VerifyCsrfToken constructor.
     * @param $c
     */
    public function __construct($c)
    {
        $this->sessionBag = $c['sessionBag'];
    }

    /**
     * Create a new verify token and save to session
     *
     * @return string
     */
    public function createToken()
    {
        $token = md5(uniqid(microtime(true), true));
        $tokenSet = $this->sessionBag->get(self::TOKEN_KEY);
        $tokenSet = json_decode($tokenSet, true);

        if (is_array($tokenSet) && count($tokenSet) >= 2) {
            array_shift($tokenSet);
        }

        $tokenSet[] = $token;
        $this->sessionBag->set(self::TOKEN_KEY, json_encode($tokenSet));
        return $token;
    }

    /**
     * Verify post token
     *
     * @param $token
     * @return bool
     */
    public function comparedToken($token)
    {
        $tokenSet = $this->sessionBag->get(self::TOKEN_KEY) ? json_decode($this->sessionBag->get(self::TOKEN_KEY), true)
            : [];

        if (!$tokenSet || !in_array($token, $tokenSet)) {
            return false;
        }

        unset($tokenSet[array_search($token, $tokenSet)]);
        return true;
    }
}
