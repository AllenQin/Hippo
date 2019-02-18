<?php
namespace User;
use App\Library\Core\MVC\EloquentModel;


/**
 * Class UserModel
 * @package User
 *
 * @property string $user_name
 * @property integer $age
 */
class UserModel extends EloquentModel
{
    protected $table = 'user';
}
