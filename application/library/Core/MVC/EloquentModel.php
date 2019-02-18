<?php
namespace App\Library\Core\MVC;

use Illuminate\Database\Eloquent\Model;

class EloquentModel extends Model
{
    protected $dateFormat = 'U';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
