<?php
namespace App\Library\Core\MVC;

use App\Defines\OuterCode;
use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Yaf\Controller_Abstract;
use Yaf\Exception\LoadFailed\Action;

class ApiController extends Controller_Abstract implements InjectionWareInterface
{
    use InjectionWareTrait;
    use ApiTrait;

    public $yafAutoRender = false;

    public function init()
    {
        header('Content-type:text/json');

        set_exception_handler([$this, 'catchException']);
    }

    public function catchException(\Exception $e)
    {
        if ($e instanceof Action) {
            return $this->error(OuterCode::NOT_DEFINED_ACTION, 'not find action');
        } else {
            return $this->error($e->getCode(), $e->getMessage());
        }
    }
}
