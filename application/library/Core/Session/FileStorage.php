<?php
namespace App\Library\Core\Session;

class FileStorage implements StorageInterface
{
    public function __construct()
    {
        session_start();
    }

    /**
     * get storage type
     *
     * @return mixed
     */
    public function getStorageType()
    {
        return 'file';
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
        return $_SESSION[$key];
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
        return $_SERVER[$key] = $value;
    }

    /**
     * get session all items value
     *
     * @return mixed
     */
    public function getAll()
    {
        return $_SESSION;
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
        unset($_SESSION[$key]);
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
        session_destroy();
    }

    /**
     * get system or custom session id
     *
     * @return mixed
     */
    public function getSessionId()
    {
        return session_id();
    }

}
