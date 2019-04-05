<?php

use App\Library\Core\MVC\Controller;
use App\Model\Jobs\Security\checkLoginIPJob;

class IndexController extends Controller
{
    public function indexAction()
    {
        $message = $this->userIdentity->isGuest ? 'Hello, Hippo'
            : 'Hello, ' . $this->userIdentity->userData['username'];

        return $this->display('index', ['content' => $message]);
    }

    /**
     * Post detail page
     */
    public function showAction()
    {
        return $this->display('show', ['editForm' => '']);
    }
}
