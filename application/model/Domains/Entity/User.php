<?php
namespace App\Model\Domains\Entity;

use App\Library\Core\MVC\EloquentModel;


/**
 * Class User
 *
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @package App\Model
 */
class User extends EloquentModel
{
    protected $table = 'users';

    protected $fillable = ['username', 'nickname', 'password', 'token', 'status'];
    protected $hidden = ['password', 'token'];

    // other relation
    // this->belongsTo Or $this->belongsToMany
}
