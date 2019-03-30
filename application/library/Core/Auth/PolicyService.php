<?php
namespace App\Library\Core\Auth;

/**
 * Class PolicyService
 * @package App\Library\Core\Auth
 */
class PolicyService
{
    /**
     * @var
     */
    private $policies;
    /**
     * @var
     */
    private $instance;

    /**
     * PolicyService constructor.
     * @param $policies
     */
    public function __construct($policies)
    {
        $this->policies = $policies;
    }

    /**
     * @param $modelClass
     * @return array
     */
    public function getPolicyModel($modelClass)
    {
        if (is_object($modelClass)) {
            $modelClass = get_class($modelClass);
        }

        if (!isset($this->policies[$modelClass])) {
           return [];
        }

        if (!isset($this->instance[$modelClass])) {
            $this->instance[$modelClass] = new $this->policies[$modelClass];
        }

        return $this->instance[$modelClass];
    }
}
