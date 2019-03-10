<?php

use App\Library\Core\MVC\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        if ($username = $this->di->get('sessionBag')->get('username')) {
            $message = 'Hello, ' . $username;
        } else {
            $message = 'Hello, Hippo!';
        }

        $this->display('index', ['content' => $message]);
    }

    /**
     * Post detail page
     */
    public function showAction()
    {

    }
}
