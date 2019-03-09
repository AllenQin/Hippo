<?php
namespace App\Model\Domains\Repositories\User;

use App\Model\User;


class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * find user entity
     *
     * @param $id
     * @return User
     */
    public function find($id)
    {
        return $this->user->find($id);
    }

    public function findByUserName($userName)
    {
        return $this->user->where('username', $userName)->get();
    }

    public function findByToken($token)
    {
        return $this->user->where('token', $token)->get();
    }
}


