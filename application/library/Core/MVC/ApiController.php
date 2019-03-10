<?php
namespace App\Library\Core\MVC;

use App\Defines\OuterCode;
use Yaf\Application;
use Yaf\Exception\LoadFailed\Action;

class ApiController extends BaseController
{
    use ApiTrait;

    public function init()
    {
        header('Content-type:text/json;charset=utf-8');
        set_exception_handler([$this, 'catchException']);
    }

    public function catchException(\Exception $e)
    {
        if ($e instanceof Action) {
            return $this->error(OuterCode::NOT_DEFINED_ACTION, 'not find action');
        } else {
            $this->logger->error('request error', [$e->getMessage()]);
            return $this->error($e->getCode(), $e->getMessage());
        }
    }
}
