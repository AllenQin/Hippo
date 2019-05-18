<?php

use App\Library\Core\MVC\Controller;
use App\Model\Domains\Repositories\Article\ArticleRepository;
use App\Model\Transformers\Article\ArticleHomeTransformer;

/**
 * Class ArticleController
 */
class ArticleController extends Controller
{
    /**
     * Article home page
     *
     * @param ArticleRepository $articleRepository
     * @param ArticleHomeTransformer $articleHomeTransformer
     * @return bool
     */
    public function indexAction(ArticleRepository $articleRepository, ArticleHomeTransformer $articleHomeTransformer)
    {
        $limit = 10;
        $page = (int)$this->getQuery('page', 1);
        $offset = ($page - 1) * $limit;

        $result = $articleRepository->findPublishArticleByPaginate($offset, $limit);
        $articleCollection = $result['list'];

        $page = [
            'previous' => $page > 1 ? true : false,
            'next' => $result['count'] > $offset + $limit ? true : false,
            'previous_page' => $page ? $page - 1 : 1,
            'next_page' => $page + 1,
        ];

        return $this->display('index', [
            'articles' => $articleHomeTransformer->transform($articleCollection),
            'page' => $page,
        ]);
    }

    /**
     * Article info page
     *
     * @param int $id
     * @param ArticleRepository $articleRepository
     * @param ArticleHomeTransformer $articleHomeTransformer
     * @return bool
     */
    public function showAction($id = 0, ArticleRepository $articleRepository, ArticleHomeTransformer $articleHomeTransformer)
    {
        $article = $articleRepository->find($id);

        return $this->display('show', [
            'article' => $articleHomeTransformer->transformOne($article),
        ]);
    }
}