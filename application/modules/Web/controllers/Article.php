<?php

use App\Library\Core\MVC\Controller;
use App\Model\Domains\Repositories\Article\ArticleRepository;
use App\Model\Forms\ArticleForm;
use App\Model\Transformers\Article\ArticleHomeTransformer;

/**
 * Class ArticleController
 *
 * @property ArticleRepository $articleRepository
 * @property ArticleHomeTransformer $articleTransformer
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
        $articleCollection = $articleRepository->findLastPublishArticle(10);

        return $this->display('index', [
            'articles' => $articleHomeTransformer->transform($articleCollection),
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

    /**
     * Save article
     */
    public function storageAction()
    {

    }

    /**
     * Display an Article form
     */
    public function createAction()
    {
        $form = new ArticleForm();

        return $this->display('create', [
            'form' => $form->getCreateForm(),
        ]);
    }
}