<?php
namespace App\Library\Core\Verify;

use App\Library\Core\Session\SessionBag;

class VerifyCsrfToken
{
    const TOKEN_KEY = 'user_csrf_token';

    /** @var SessionBag $sessionBag **/
    private $sessionBag;

    public function __construct($c)
    {
        $this->sessionBag = $c['sessionBag'];
    }

    public function createToken()
    {
        $token = md5(uniqid(microtime(true), true));
        $tokenSet = $this->sessionBag->get(self::TOKEN_KEY);
        if ($tokenSet = json_decode($tokenSet, true)) {
            if (count($tokenSet) >= 2) {
                array_shift($tokenSet);
            }
            $tokenSet[] = $token;
        } else {
            $tokenSet[] = $token;
        }

        $this->sessionBag->set(self::TOKEN_KEY, json_encode($tokenSet));
        return $token;
    }

    public function comparedToken($token)
    {
        $tokenSet = $this->sessionBag->get(self::TOKEN_KEY) ? json_decode($this->sessionBag->get(self::TOKEN_KEY), true)
            : [];

        if (!$tokenSet || !in_array($token, $tokenSet)) {
            return false;
        } else {
            unset($tokenSet[array_search($token, $tokenSet)]);
            return true;
        }
    }
}
