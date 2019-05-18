<?php

use App\Library\Core\MVC\Controller;
use App\Model\Domains\Repositories\Article\ArticleRepository;
use App\Model\Transformers\Article\ArticleHomeTransformer;

/**
 * Class IndexController
 */
class IndexController extends Controller
{
    /**
     * Blog home page
     *
     * @param ArticleRepository $articleRepository
     * @param ArticleHomeTransformer $articleHomeTransformer
     * @return bool
     */
    public function indexAction(ArticleRepository $articleRepository, ArticleHomeTransformer $articleHomeTransformer)
    {
        $articles = $articleRepository->findLastPublishArticle(5);
        $articles = $articleHomeTransformer->transform($articles);

        return $this->display('index', compact('articles'));
    }
}
