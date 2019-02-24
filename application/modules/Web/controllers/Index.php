<?php

use App\Library\Core\MVC\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->display('index', ['content' => 'Hello Hippo!']);
    }

    public function testAction()
    {
        $this->getResponse()->setBody('test string');
    }
}
