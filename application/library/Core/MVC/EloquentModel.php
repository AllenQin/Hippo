<?php
namespace App\Library\Core\MVC;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentModel
 *
 * @package App\Library\Core\MVC
 */
class EloquentModel extends Model
{
    protected $dateFormat = 'U';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected function asDateTime($value)
    {
        return $value;
    }
}
