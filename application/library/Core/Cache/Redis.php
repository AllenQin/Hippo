<?php
namespace App\Library\Core\Cache;

class Redis implements CacheInterface
{
    private $_instance;

    public function __construct($config)
    {
        $redis = new \Redis();
        $redis->connect($config['host'], $config['port']);
        // @todo user auth

        $redis->select($config['dbname']);
        $this->_instance = $redis;
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
        return $this->_instance->set($key, $value, $duration);
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
        $key = $this->buildKey($key);
        return $this->_instance->exists($key);
    }

    public function hSet($key, $field, $value, $duration = 0)
    {
        $key = $this->buildKey($key);
        $result = $this->_instance->hSet($key, $field, $value);
        if ($duration) {
            $this->_instance->expire($key, $duration);
        }

        return $result;
    }

    public function hGet($key, $field)
    {
        $key = $this->buildKey($key);
        return $this->_instance->hGet($key, $field);
    }

    public function hGetAll($key)
    {
        $key = $this->buildKey($key);
        return $this->_instance->hGetAll($key);
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
        return false;
    }

}
