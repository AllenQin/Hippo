<?php

use App\Library\Core\Cache\Redis;
use App\Library\Core\MVC\ApiController;

class IndexController extends ApiController
{
    public function indexAction()
    {
        /* @var Redis $cache */
        $cache = $this->cache;
        $value = $cache->get('name');
        if ($value === false) {
            $cache->set('name', 'allen', 60);
        }

        return $this->success(['content' => $value]);
    }
}
