<?php
namespace App\Model\Transformers\Article;

use App\Library\Core\MVC\TransformContract;
use App\Model\Domains\Entity\Article;
use Illuminate\Support\Collection;

class ArticleHomeTransformer implements TransformContract
{
    /**
     * @param Collection $collection
     * @return Collection
     */
    public function transform(Collection $collection)
    {
        return $collection->map(function (Article $article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'summary' => mb_substr($article->content, 0, 300) . '......',
                'content' => $article->content,
                'author' => $article->user->nickname,
                'created_at' => $article->created_at,
            ];
        });
    }

    /**
     * @param Article $article
     * @return array
     */
    public function transformOne($article)
    {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'content' => $article->content,
            'author' => $article->user->nickname,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,
        ];
    }
}
