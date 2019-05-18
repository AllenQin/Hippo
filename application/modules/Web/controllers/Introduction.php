<?php

use App\Library\Core\MVC\Controller;

class IntroductionController extends Controller
{
    public function indexAction()
    {
        $this->display('index');
    }
}
