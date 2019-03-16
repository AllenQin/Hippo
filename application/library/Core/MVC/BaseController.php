<?php
namespace App\Library\Core\MVC;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Yaf\Controller_Abstract;

/**
 * Class BaseController
 *
 *
 * @package App\Library\Core\MVC
 */
class BaseController extends Controller_Abstract implements InjectionWareInterface
{
    use InjectionWareTrait;
    public $yafAutoRender = false;

    public function getQuery($name = '', $default = '')
    {
        if ($name) {
            return $this->getRequest()->getQuery($name, $default);
        } else {
            return $this->getRequest()->getQuery();
        }
    }

    public function getPost($name = '', $default = '')
    {
        if ($name) {
            return $this->getRequest()->getPost($name, $default);
        } else {
            return $this->getRequest()->getPost();
        }
    }

    public function getParam($name, $default = '')
    {
        return $this->getRequest()->getParam($name, $default);
    }

    public function getParams()
    {
        return $this->getRequest()->getParams();
    }

    public function getMethod()
    {
        return $this->getRequest()->getMethod();
    }

    public function isCli()
    {
        return $this->getRequest()->isCli();
    }

    public function isGet()
    {
        return $this->getRequest()->isGet();
    }

    public function isPost()
    {
        return $this->getRequest()->isPost();
    }

    public function isPut()
    {
        return $this->getRequest()->isPut();
    }

    public function isHead()
    {
        return $this->getRequest()->isHead();
    }

    public function isOptions()
    {
        return $this->getRequest()->isOptions();
    }

    public function isAjax()
    {
        return $this->getRequest()->isXmlHttpRequest();
    }

    public function request()
    {
        return $this->getRequest();
    }

    public function redirect($uri, $params = [])
    {
        if (is_array($uri)) {
            $uri =  '/' . implode('/', $uri);
        }

        if ($params) {
            $uri .= '?' . http_build_query($params);
        }

        return parent::redirect($uri);
    }
}
