<?php

use App\Library\Core\Cache\Redis;
use App\Library\Core\MVC\ApiController;
use App\Models\Repositories\UserRepository;
use Entity\UserModel;

class IndexController extends ApiController
{
    public function indexAction()
    {
        $user = $this->di->get('userRepository')->load(1);

        return $this->success($user);
    }
}
