<?php

use App\Library\Core\MVC\ApiController;

class IndexController extends ApiController
{
    public function indexAction()
    {
        return $this->success();
    }
}
