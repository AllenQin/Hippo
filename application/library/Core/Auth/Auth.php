<?php
namespace App\Library\Core\Auth;

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

    /**
     * Auth constructor.
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
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

        if ($policy = Registry::get('di')->get('policy')->getPolicyModel($model)) {
            if (!method_exists($policy, $policyAction)) {
                throw new \Exception(get_class($policy) . ' method ' . $policyAction . 'is not exists!');
            }

            return $policy->$policyAction($this->user, $model);
        }

        return false;
    }

    /**
     * @param UserInterface $user
     * @return Auth
     */
    public function forUser(UserInterface $user)
    {
        return new Auth($user);
    }
}
