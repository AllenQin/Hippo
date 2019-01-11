<?php
namespace App\Library\Core\Di;

use App\Library\Core\Di\ContainerInterface;
use Pimple\Container as PimpleContainer;
use Yaf\Exception;

class Container implements ContainerInterface, \ArrayAccess
{
    protected $pimple;

    protected static $default;

    /**
     * Container constructor.
     * @param $services
     */
    public function __construct($services)
    {
        $this->pimple = new PimpleContainer();

        foreach ($services as $key => $value) {
            $this->offsetSet($key, $value);
        }

        static::$default = $this;
    }

    /**
     * @param $name
     * @param $service
     * @return mixed
     */
    function set($name, $service)
    {
        $this->offsetSet($name, $service);
    }

    /**
     * @param $name
     * @return mixed
     */
    function get($name)
    {
        if (!$this->pimple[$name] && class_exists($name)) {
            $this->offsetSet($name, $name);
        }

        return $this->pimple[$name];
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->pimple[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_string($value)) {
            $cls = $value;
            if (!class_exists($cls)) {
                throw new Exception('only support class name and anonymous function');
            }

            $value = function () use ($cls) {
                $obj = new $cls;
                if ($obj instanceof InjectionWareInterface) {
                    $obj->setDi($this);
                }
            };
        } else {
            $old = $value;
            $value = function ($container) use ($old) {
                $obj = $old($container);
                if ($obj instanceof InjectionWareInterface) {
                    $obj->setDi($this);
                }
                return $obj;
            };
        }

        $this->pimple[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->pimple[$offset]);
    }

    public function getRaw($name)
    {
        return $this->pimple->raw($name);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->pimple, $name], $arguments);
    }

    /**
     * @param $di
     */
    public static function setDefault($di)
    {
        static::$default = $di;
    }

    /**
     * @return Container
     */
    public static function getDefault()
    {
        if (!static::$default) {
            return new static();
        }

        return static::$default;
    }
}



