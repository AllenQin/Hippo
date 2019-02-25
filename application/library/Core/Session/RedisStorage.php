<?php
namespace App\Library\Core\Session;

use App\Library\Core\Cache\Redis;

class RedisStorage implements StorageInterface
{
    private $redis;

    public function __construct(Redis $redis)
    {
        //@todo get or generate unique session id and write cookie

        $this->redis = $redis;
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
        // TODO: Implement set() method.
    }

    /**
     * get session all items value
     *
     * @return mixed
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
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
        // TODO: Implement delete() method.
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
        // TODO: Implement destroy() method.
    }

    /**
     * get system or custom session id
     *
     * @return mixed
     */
    public function getSessionId()
    {
        // TODO: Implement getSessionId() method.
    }

}
