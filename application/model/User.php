<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

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
class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['username', 'nickname', 'token', 'password', 'status'];
    protected $hidden = ['password', 'token'];

    protected $dateFormat = 'U';
}
