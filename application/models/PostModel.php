<?php

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostModel
 */
class PostModel extends Model
{
    protected $table = 'posts';

    protected $dateFormat = 'U';
}
