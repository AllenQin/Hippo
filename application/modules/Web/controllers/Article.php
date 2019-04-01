<?php

use App\Library\Core\MVC\Controller;
use App\Model\Domains\Entity\Article;
use App\Model\Domains\Repositories\Article\ArticleRepository;
use App\Model\Transformers\Article\ArticleHomeTransformer;

/**
 * Class ArticleController
 *
 * @property ArticleRepository $articleRepository
 * @property ArticleHomeTransformer $articleTransformer
 */
class ArticleController extends Controller
{
    private $articleRepository;
    private $articleTransformer;

    public function init()
    {
        $this->articleRepository = new ArticleRepository();
        $this->articleTransformer = new ArticleHomeTransformer();

        parent::init();
    }

    /**
     * Article home page
     *
     * @return bool
     */
    public function indexAction()
    {
        $articleCollection = $this->articleRepository->findLastPublishArticle(10);

        return $this->display('index', [
            'articles' => $this->articleTransformer->transform($articleCollection),
        ]);
    }

    /**
     * Article info page
     *
     * @param integer $id
     * @return bool
     */
    public function showAction($id = 0)
    {
        $article = $this->articleRepository->find($id);

        return $this->display('show', [
            'article' => $this->articleTransformer->transformOne($article),
        ]);
    }
}