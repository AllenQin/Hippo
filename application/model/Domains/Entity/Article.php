<?php

namespace App\Model\Domains\Entity;

use App\Library\Core\MVC\EloquentModel;

/**
 * Class Article
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $author_id
 * @property boolean $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property User $user
 *
 */
class Article extends EloquentModel
{
	protected $table = 'articles';

	protected $fillable = ['id', 'title', 'author_id', 'status', 'content'];

	public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
