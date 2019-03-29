<?php
namespace App\Model\MiddleWares;

use App\Library\Core\MiddleWare\MiddleWareInterface;
use App\Library\Core\Service\ServiceWrapper;
use Yaf\Request_Abstract;

class Auth extends ServiceWrapper implements MiddleWareInterface
{
    public function handle(Request_Abstract $request)
    {
        // only accept Ajax request
        if (!$request->isXmlHttpRequest()) {
            throw new \Exception('only accept Ajax request');
        }
    }
}
