<?php
namespace Entity;
use App\Library\Core\MVC\EloquentModel;


/**
 * Class UserModel
 * @package User
 *
 * @property integer $id
 * @property string $user_name
 * @property integer $age
 */
class UserModel extends EloquentModel
{
    protected $table = 'user';
}
