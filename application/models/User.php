<?php

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserModel
 */
class UserModel extends Model
{
    protected $table = 'users';

    protected $dateFormat = 'U';

    protected $fillable = [
        'username', 'password', 'token', 'status',
    ];

    protected $hidden = [
        'password',
    ];
}
