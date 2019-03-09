<?php

use App\Library\Core\MVC\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $user = $this->di->get('userRepository')->find(1);
        $this->display('index', ['content' => 'Hello, ' . $user->nickname]);
    }

    /**
     * Post detail page
     */
    public function showAction()
    {

    }
}
