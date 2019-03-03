<?php

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserModel
 */
class UserModel extends Model
{
    protected $table = 'users';

    protected $dateFormat = 'U';
}
