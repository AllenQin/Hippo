<?php
namespace App\Services\User;

class UserSignInService extends UserService
{
    public function validator(array $data)
    {
        $rule = [
            'username' => 'required|string|min:6|max:20',
            'password' => 'required|max:20|min:6',
        ];

        return $this->assert->validate($rule, $data);
    }

    public function signIn($data)
    {
        if ($this->validator($data) !== true) {
            return false;
        }

        if (!$user = $this->userRepository->findBy('username', $data['username'])) {
            $this->assert->pushErrorMessage('username', '用户名不存在');
            return false;
        }

        if (!$this->assertPassword($data['password'], $user->password)) {
            $this->assert->pushErrorMessage('password', '密码不正确');
            return false;
        }

        $this->di->get('userIdentity')->loginUser($user);

        return $user;
    }
}
