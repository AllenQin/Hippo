<?php
namespace App\Library\Core\Cache;

use Yaf\Exception;

class Memcache implements CacheInterface
{
    /* @var \Memcache $_instance */
    private $_instance;

    public function __construct($config)
    {
        if (!($this->_instance = (new \Memcache())->connect($config['host'], $config['port']))) {
            throw new Exception('connection memcached error');
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function buildKey($key)
    {
        if (is_array($key)) {
            $key = json_encode($key);
        }

        if (is_object($key)) {
            $key = (string)$key;
        }

        return $key;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        $key = $this->buildKey($key);
        return $this->_instance->get($key);
    }

    /**
     * @param $keys
     * @return mixed
     */
    public function mget($keys)
    {
        // TODO: Implement mget() method.
    }

    /**
     * @param $key
     * @param $value
     * @param $duration
     * @return mixed
     */
    public function set($key, $value, $duration)
    {
        $key = $this->buildKey($key);
        return $this->_instance->set($key, $value, 0, $duration);
    }

    /**
     * @param $items
     * @param $duration
     * @return mixed
     */
    public function mset($items, $duration)
    {
        // TODO: Implement mset() method.
    }

    /**
     * @param $key
     * @return mixed
     */
    public function exists($key)
    {
        // TODO: Implement exists() method.
    }

    /**
     * @param $key
     * @return mixed
     */
    public function delete($key)
    {
        $key = $this->buildKey($key);
        return $this->_instance->delete($key);
    }

    /**
     * @return mixed
     */
    public function flush()
    {
        return $this->_instance->flush();
    }

}
