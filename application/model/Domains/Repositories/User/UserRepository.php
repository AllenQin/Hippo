<?php
namespace App\Model\Domains\Repositories\User;

use App\Defines\User;
use App\Model\Domains\Entity\User as UserEntity;
use App\Model\Domains\Repositories\AbstractRepository;

/**
 * Class UserRepository
 *
 * @package App\Model\Domains\Repositories\User
 */
class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new UserEntity();
        $this->modelName = UserEntity::class;
    }

    /**
     * @return mixed
     */
    public function getAllUserActivated()
    {
        return $this->model->where('status', User::STATUS_ACTIVATED)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}


