<?php

use App\Library\Core\MVC\ApiController;

class IndexController extends ApiController
{
    public function indexAction()
    {
        $user = $this->di->get('userRepository')->getUserListForApi(0, 3);
        return $this->success($user);
    }
}
