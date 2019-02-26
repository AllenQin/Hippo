<?php
namespace App\Library\Core\Cookie;

use Delight\Cookie\Cookie;

class CookieService
{
    private $domain;
    private $defaultExpire = 86400;

    public function __construct($container)
    {
        $this->domain = $container['config']['cookie']['domain'];
    }

    public function set($name, $value, $domain = null, $expire = null, $httpOnly = true)
    {
        return (new Cookie($name))->setDomain($domain ?: $this->domain)
            ->setExpiryTime(time() + ($expire ?: $this->defaultExpire))
            ->setHttpOnly($httpOnly)
            ->setValue($value)
            ->save();
    }

    public function get($name)
    {
        return Cookie::get($name);
    }

    public function exists($name)
    {
        return Cookie::exists($name);
    }

    public function delete($name)
    {
        return (new Cookie($name))->delete();
    }
}
