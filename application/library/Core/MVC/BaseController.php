<?php
namespace App\Library\Core\MVC;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Yaf\Controller_Abstract;

/**
 * Class BaseController
 *
 * @package App\Library\Core\MVC
 */
class BaseController extends Controller_Abstract implements InjectionWareInterface
{
    use InjectionWareTrait;
    public $yafAutoRender = false;

    public function getQuery($name, $default = '')
    {
        return $this->getRequest()->getQuery($name, $default);
    }

    public function getPost($name, $default = '')
    {
        return $this->getRequest()->getPost($name, $default);
    }

    public function getParams($name, $default = '')
    {
        return $this->getRequest()->getParam($name, $default);
    }

    // other methods ...
}
