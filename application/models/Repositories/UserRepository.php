<?php
namespace App\Models\Repositories;

use Entity\UserModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 *
 * @property UserModel $user
 *
 * @package App\Models\Repositories
 */
class UserRepository
{
    protected $user;

    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function load($id)
    {
        return $this->user->find($id);
    }

    /**
     * 回传大于$age年纪的数据
     *
     * @param $age
     * @return Collection
     */
    public function scopeGetAgeLargerThan($age)
    {
        return $this->user
            ->where('age', '>', $age)
            ->orderBy('age')
            ->get();
    }

    public function getUserListForApi($offset, $limit)
    {
        $users = UserModel::take($limit)->skip($offset)->get();
        $users = $users->transform(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->user_name,
                'is_young' => $user->age <= 18 ? 1 : 0,
            ];
        });

        return $users;
    }
}
