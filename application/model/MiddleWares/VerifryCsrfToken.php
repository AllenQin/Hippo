<?php
namespace App\Model\MiddleWares;

use App\Library\Core\MiddleWare\MiddleWareInterface;
use App\Library\Core\Service\ServiceWrapper;
use Yaf\Request_Abstract;

class VerifryCsrfToken extends ServiceWrapper implements MiddleWareInterface
{
    public function handle(Request_Abstract $request)
    {
        if ($request->isPost()) {
            $token = $request->getPost('csrf_token', false);
            if (!$token) {
                throw new \Exception('verify csrf_token fail') ;
            }

            if (!$this->di->get('verifyCsrfToken')->comparedToken($token)) {
                throw new \Exception('verify csrf_token fail') ;
            }
        }

        return $request;
    }
}
