<?php
namespace App\Library\Core\Auth;

use App\Library\Core\Di\Container;
use Yaf\Registry;

/**
 * Class Auth
 * @package App\Library\Core\Auth
 */
class Auth
{
    /**
     * @var UserInterface
     */
    private $user;

    private $container;

    /**
     * Auth constructor.
     * @param UserInterface $user
     */
    public function __construct($c)
    {
        $this->container = $c;
        $user = $this->container['userRepository']->find($this->container['userIdentity']->getUid());
        $this->user = $user;
    }

    /**
     * @param $policyAction
     * @param $model
     * @return bool
     * @throws \Exception
     */
    public function can($policyAction, $model)
    {
        if (!$this->user) {
           return false;
        }

        if ($policy = $this->container['policy']->getPolicyModel($model)) {
            if (!method_exists($policy, $policyAction)) {
                throw new \Exception(get_class($policy) . ' method ' . $policyAction . 'is not exists!');
            }

            return $policy->$policyAction($this->user, $model);
        }

        return false;
    }
}
