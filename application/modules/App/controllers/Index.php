<?php

use App\Library\Core\Cache\Redis;
use App\Library\Core\MVC\ApiController;

class IndexController extends ApiController
{
    public function indexAction()
    {
        $cache = $this->di->get('cache');
        $value = $cache->get('name');
        if ($value === false) {
            $cache->set('name', 'allen', 60);
        }

        $rule = [
            'username' => 'required|string|min:2|max:5',
        ];
        $data = [
            'username' => 'allenqin',
            'age' => 20,
        ];

        $this->assert->validate($rule, $data);

        return $this->success(['content' => $value]);
    }
}
