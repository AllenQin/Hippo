<?php

use App\Library\Core\Controller;
use GuzzleHttp\Client;

class IndexController extends Controller
{
    public function indexAction()
    {
        /* @var $client Client */
        $client = $this->di->get('httpClient');

        $this->display('index', ['content' => 'Hello World']);
    }
}
