<?php
namespace App\Model\Domains\Repositories\Article;

use App\Defines\Article;
use App\Model\Domains\Entity\Article as ArticleEntity;
use App\Model\Domains\Repositories\AbstractRepository;

class ArticleRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(new ArticleEntity());
    }

    /**
     * Query articles to be published
     *
     * @param $offset
     * @param $limit
     * @return array
     */
    public function findPendingArticleByPaginate($offset, $limit)
    {
        $query = $this->model->where('status', Article::STATUS_PENDING);
        return [
            'count' => $query->count(),
            'list' => $query->offset($offset)->take($limit)->get(),
        ];
    }

    /**
     * Get the latest $limit articles published
     *
     * @param $limit
     * @return mixed
     */
    public function findLastPublishArticle($limit)
    {
        return $this->model->where('status', Article::STATUS_PUBLISH)
            ->orderBy('id', 'desc')
            ->take($limit)->get();
    }
}
