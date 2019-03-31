<?php

use App\Library\Core\MVC\Controller;
use App\Model\Domains\Entity\Article;
use App\Model\Domains\Repositories\Article\ArticleRepository;

class IndexController extends Controller
{
    public function indexAction()
    {
        $message = $this->userIdentity->isGuest ? 'Hello, Hippo'
            : 'Hello, ' . $this->userIdentity->userData['username'];

        return $this->display('index', ['content' => $message]);
    }

    /**
     * Post detail page
     */
    public function showAction()
    {
        return $this->display('show', ['editForm' => '']);
    }

    public function checkAuthAction()
    {
        $articleRep = new ArticleRepository(new Article());
        $article = $articleRep->find(1);

        $this->auth->can('update', $article);
    }
}
