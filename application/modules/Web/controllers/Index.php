<?php

use App\Library\Core\MVC\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->di->get('sessionBag')->set('user_name', 'allen');
        $this->display('index', ['content' => 'Hello Hippo!']);
    }
}
