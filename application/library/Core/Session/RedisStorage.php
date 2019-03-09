<?php
namespace App\Library\Core\Session;

use App\Library\Core\Cookie\CookieService;
use App\Library\Core\Encrypt\JWTService;

class RedisStorage implements StorageInterface
{
    private $redis;
    private $authId;
    private $uniqueId;

    public function __construct($container)
    {
        $this->redis = $container['redis'];

        /* @var CookieService $cookie */
        $cookie = $container['cookieSrv'];

        /* @var JWTService $jwt */
        $jwt = $container['jwtSrv'];

        $this->authId = md5($container['config']['auth']['id']);

        if ($cookie->exists($this->authId) &&
            $jwtDecode = $jwt->encryptDecode($cookie->get($this->authId))) {
            $this->uniqueId = $jwtDecode->val;
        } else {
            // @todo use global unique service
            if (function_exists('create_session_id')) {
                $this->uniqueId = create_session_id();
            } else {
                $this->uniqueId = md5(uniqid(microtime(true), true));
            }

            $jwtEncode = $jwt->encryptEncode($this->uniqueId);
            $cookie->set($this->authId, $jwtEncode);
        }
    }

    /**
     * get storage type
     *
     * @return mixed
     */
    public function getStorageType()
    {
        return 'redis';
    }

    /**
     * get session single item value
     *
     * @param int|string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->redis->hGet($this->getSessionId(), $key);
    }

    /**
     * set up session single item value
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return $this->redis->hSet($this->getSessionId(), $key, $value);
    }

    /**
     * get session all items value
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->redis->hGetAll($this->getSessionId());
    }

    /**
     * delete session single item value
     *
     * @param $key
     *
     * @return mixed
     */
    public function delete($key)
    {
        return $this->redis->hSet($this->getSessionId(), $key, null);
    }

    /**
     * destroy session storage
     *
     * This is a dangerous operation
     *
     * @return mixed
     */
    public function destroy()
    {
        return $this->redis->delete($this->getSessionId());
    }

    /**
     * get system or custom session id
     *
     * @return mixed
     */
    public function getSessionId()
    {
        $this->uniqueId;
    }
}
