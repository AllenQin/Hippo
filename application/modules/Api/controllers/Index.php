<?php

use App\Library\Core\MVC\ApiController;

class IndexController extends ApiController
{
    public function indexAction()
    {
        $uid = $this->getQuery('id', 0);

        $user = $this->di->get('userRepository')->load($uid);
        return $this->success($user);
    }
}
