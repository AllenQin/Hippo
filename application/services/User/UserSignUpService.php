<?php
namespace App\Services\User;

use App\Model\Events\User\UserSignUpEvent;

/**
 * Class UserSignUpService
 *
 * User SignUp Service
 *
 * @package App\Services\User
 */
class UserSignUpService extends UserService
{
    /**
     * @param array $data
     * @return bool
     */
    public function validator(array $data)
    {
        $rule = [
            'username' => 'required|string|min:6|max:20',
            'password' => 'required|max:20|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];

        return $this->assert->validate($rule, $data);
    }

    /**
     * @param array $data
     * @param bool $isAutoLogin
     * @return bool|mixed
     */
    public function signUp(array $data, $isAutoLogin = false)
    {
        if ($this->validator($data) !== true) {
            return false;
        }

        // validator username
        if ($this->userRepository->findCountBy('username', $data['username'])) {
            $this->assert->pushErrorMessage('username', 'username is exists!');
            return false;
        }

        $data = array_merge($data, $this->generatePwdAndToken($data['password']));
        if (!$user = $this->userRepository->create($data)) {
            // @todo throw new Exception

            return false;
        }

        $this->eventDispatcher->dispatch(UserSignUpEvent::getEventName(), (new UserSignUpEvent($user)));

        if ($isAutoLogin) {
            $stageUserSession = $this->filterSessionSensitive($user);
            $this->di->get('sessionBag')->multipleSet($stageUserSession);
        }

        return $user;
    }

    /**
     * @param $password
     * @return array
     */
    private function generatePwdAndToken($password)
    {
        return [
            'password' => $this->generatePassword($password),
            'token' => $this->generateToken(),
        ];
    }
}
