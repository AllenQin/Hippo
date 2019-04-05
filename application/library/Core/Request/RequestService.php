<?php
namespace App\Library\Core\Request;

use Yaf\Registry;
use Yaf\Request_Abstract;

class RequestService
{
    /**
     * @var Request_Abstract
     */
    private $request;

    public function __construct($container)
    {
        $this->request = Registry::get('request');
    }

    public function getRequest()
    {
        return $this->request;
    }
}
