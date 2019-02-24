<?php

use App\Library\Core\MVC\ApiController;

class IndexController extends ApiController
{
    public function indexAction()
    {
        $user = $this->di->get('userRepository')->load(1);
        return $this->success($user);
    }
}
