<?php

namespace App\Model\Domains\Entity;

use App\Library\Core\MVC\EloquentModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 *
 * @property integer id
 * @property string title
 * @property integer author_id
 * @property boolean status
 * @property integer created_at
 * @property integer updated_at
 * @property User $user
 *
 * @method
 */
class Article extends EloquentModel
{
	protected $table = 'articles';

	protected $fillable = ['id', 'title', 'author_id', 'status'];

	public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
