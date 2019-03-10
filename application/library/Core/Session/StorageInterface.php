<?php
namespace App\Library\Core\Session;

interface StorageInterface
{
    /**
     * get storage type
     *
     * @return mixed
     */
    public function getStorageType();

    /**
     * get session single item value
     *
     * @param int|string $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * set up session single item value
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value);

    /**
     * set up multiple items to session
     *
     * @param $data
     * @return mixed
     */
    public function multipleSet($data);

    /**
     * get session all items value
     *
     * @return mixed
     */
    public function getAll();

    /**
     * delete session single item value
     *
     * @param $key
     *
     * @return mixed
     */
    public function delete($key);

    /**
     * destroy session storage
     *
     * This is a dangerous operation
     *
     * @return mixed
     */
    public function destroy();

    /**
     * get system or custom session id
     *
     * @return mixed
     */
    public function getSessionId();
}
