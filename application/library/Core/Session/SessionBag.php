<?php
namespace App\Library\Core\Session;

/**
 * Class SessionBag
 *
 * @package App\Library\Core\Session
 */
class SessionBag
{
    private static $_instance = null;
    private $storage;

    /**
     * SessionBag constructor.
     * @param StorageInterface $storage
     */
    private function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param StorageInterface $storage
     * @return SessionBag|null
     */
    public static function getInstance(StorageInterface $storage)
    {
        if (self::$_instance == null) {
            self::$_instance = new self($storage);
        }

        return self::$_instance;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->storage->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return $this->storage->set($key, $value);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function multipleSet($data)
    {
        return $this->storage->multipleSet($data);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->storage->getAll();
    }

    /**
     * @param $key
     * @return mixed
     */
    public function delete($key)
    {
        return $this->storage->delete($key);
    }

    /**
     * @return mixed
     */
    public function destroy()
    {
        return $this->storage->destroy();
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->storage->getSessionId();
    }

    private function __clone()
    {

    }
}
