<?php
namespace App\Model\MiddleWares;

use App\Helpers\Utils;
use App\Library\Core\MiddleWare\MiddleWareInterface;
use App\Library\Core\Service\ServiceWrapper;
use Yaf\Request_Abstract;

class OnlyGuest extends ServiceWrapper implements MiddleWareInterface
{
    public function handle(Request_Abstract $request)
    {
        if (!$this->userIdentity->isGuest) {
            Utils::redirect('/');
        }

        return $request;
    }

}
