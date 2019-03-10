<?php
namespace App\Model\Domains\Repositories\User;

use App\Defines\User;
use App\Model\Domains\Repositories\AbstractRepository;

/**
 * Class UserRepository
 *
 * @package App\Model\Domains\Repositories\User
 */
class UserRepository extends AbstractRepository
{
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


