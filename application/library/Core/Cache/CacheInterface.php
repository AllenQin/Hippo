<?php
namespace App\Library\Core\Cache;

interface CacheInterface
{
    public function buildKey($key);

    public function get($key);

    public function mget($keys);

    public function set($key, $value, $duration);

    public function mset($items, $duration);

    public function exists($key);

    public function delete($key);

    public function flush();
}
