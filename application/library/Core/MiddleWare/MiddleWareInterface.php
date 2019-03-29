<?php
namespace App\Library\Core\MiddleWare;

use Yaf\Request_Abstract;

interface MiddleWareInterface
{
    public function handle(Request_Abstract $request);
}
