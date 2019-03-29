<?php
namespace App\Library\Core\MiddleWare;

use League\Pipeline\Pipeline;
use Yaf\Request_Abstract;

class MiddleWare
{
    private $pipeline = null;

    public function __construct()
    {
        $this->pipeline = new Pipeline();
    }

    public function addMiddleWare($middleware)
    {
        $this->pipeline = $this->pipeline->pipe(function($request) use($middleware){
            if (is_string($middleware) && class_exists($middleware)) {
                return (new $middleware)->handle($request);
            } elseif ($middleware instanceof \Closure) {
                return $middleware($request);
            } else {
                throw new \Exception('not support middleware type');
            }
        });
    }

    public function run(Request_Abstract $request)
    {
        return $this->pipeline->process($request);
    }
}
