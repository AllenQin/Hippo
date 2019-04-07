<?php
namespace App\Library\Core\MVC;

use Yaf\Exception\LoadFailed\Action;

class Controller extends BaseController
{
    public function init()
    {
        if (!$this->config['application']['debug']) {
            set_exception_handler([$this, 'catchException']);
        }
    }

    public function catchException(\Exception $e)
    {
        if ($e instanceof Action) {
            // @todo response error action page

        } else {
            $this->logger->error('request error', [$e->getMessage()]);
            // @todo response error page
        }
    }

    public function display($tpl, array $parameters = null)
    {
        if (strpos($tpl, '/') === false) {
            $tpl = strtolower($this->getCurrentAction()) . '/' . $tpl;
        }
        $tpl = $tpl . '.phtml';

        return $this->getView()->display($tpl, $parameters);
    }
}
