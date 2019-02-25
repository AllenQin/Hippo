<?php

use App\Library\Core\MVC\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->display('index', ['content' => 'Hello Hippo!']);
    }

    public function loginAction()
    {
        $session = $this->di->get('sessionBag');
        echo $session->getSessionId() . PHP_EOL;
    }
}
