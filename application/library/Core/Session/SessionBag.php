<?php
namespace App\Library\Core\Session;

use App\Library\Core\Cache\Redis;

/**
 * Class SessionBag
 *
 * @property Redis $redis;
 * @package App\Library\Core\Session
 */
class SessionBag
{
    private static $_instance = null;
    private $redis;
    private $sessionId = null;

    private function __construct($redis)
    {
        session_start();
        $this->redis = $redis;
        $this->sessionId = session_id();
    }

    public static function getInstance(Redis $redis)
    {
        if (self::$_instance == null) {
            self::$_instance = new self($redis);
        }

        return self::$_instance;
    }

    public function get($key)
    {
        return $this->redis->hGet($this->sessionId, $key);
    }

    public function set($key, $value)
    {
        return $this->redis->hSet($this->sessionId, $key, $value);
    }

    public function getAll()
    {
        return $this->redis->hGetAll($this->sessionId);
    }

    public function delete($key)
    {
        return $this->redis->hSet($this->sessionId, $key, null);
    }

    public function destroy()
    {
        return $this->redis->delete($this->sessionId);
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    private function __clone()
    {

    }
}
