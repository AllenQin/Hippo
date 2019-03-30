<?php
namespace App\Model\Policies;

use App\Model\Domains\Entity\User;
use App\Model\Domains\Entity\Article;

class ArticlePolicy
{
    public function update(User $user, Article $article)
    {
        return $user->id == $article->author_id;
    }
}
