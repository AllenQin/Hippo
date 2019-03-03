<?php
namespace App\Models\Domains\Repositories\User;

class UserRepository
{
    /**
     * @var \UserModel
     */
    private $user;

    public function __construct(\UserModel $userModel)
    {
        $this->user = $userModel;
    }

    public function create($post)
    {
        return $this->user->create($post);
    }

    public function findUserById($id)
    {
        return $this->user->find($id);
    }

    public function findUserByToken($token)
    {
        return $this->user->where('token', $token)->find();
    }

    public function getLastTen()
    {

    }
}
