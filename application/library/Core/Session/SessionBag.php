<?php
namespace App\Library\Core\Session;

use App\Library\Core\Cache\Redis;

/**
 * Class SessionBag
 *
 * @package App\Library\Core\Session
 */
class SessionBag
{
    private static $_instance = null;
    private $storage;
    private $sessionId = null;

    private function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->sessionId = $this->storage->getSessionId();
    }

    public static function getInstance(StorageInterface $storage)
    {
        if (self::$_instance == null) {
            self::$_instance = new self($storage);
        }

        return self::$_instance;
    }

    public function get($key)
    {
        return $this->storage->get($key);
    }

    public function set($key, $value)
    {
        return $this->storage->set($key, $value);
    }

    public function getAll()
    {
        return $this->storage->getAll();
    }

    public function delete($key)
    {
        return $this->storage->delete($key);
    }

    public function destroy()
    {
        return $this->storage->destroy();
    }

    public function getSessionId()
    {
        return $this->storage->getSessionId();
    }

    private function __clone()
    {

    }
}
