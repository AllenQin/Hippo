<?php
namespace App\Model\Domains\Entity;

use App\Library\Core\MVC\EloquentModel;

/**
 * Class Article
 *
 * @property integer id
 * @property string title
 * @property integer author_id
 * @property boolean status
 * @property integer created_at
 * @property integer updated_at
 */
class Article extends EloquentModel
{
	protected $table = 'articles';

	protected $fillable = ['id', 'title', 'author_id', 'status', 'created_at', 'updated_at'];
}
