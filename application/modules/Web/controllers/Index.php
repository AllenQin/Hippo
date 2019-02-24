<?php

use App\Library\Core\MVC\Controller;
use App\Models\Event\OrderPlacedEvent;
use Entity\OrderModel;
use Entity\UserModel;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->display('index', ['content' => 'Hello Hippo!']);
    }
}
