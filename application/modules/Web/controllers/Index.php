<?php

use App\Library\Core\MVC\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $message = $this->userIdentity->isGuest ? 'Hello, Hippo'
            : 'Hello, ' . $this->userIdentity->userData['username'];

        $this->display('index', ['content' => $message]);
    }

    /**
     * Post detail page
     */
    public function showAction()
    {

    }
}
