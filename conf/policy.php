<?php

use App\Model\Domains\Entity\Article;
use App\Model\Policies\ArticlePolicy;

return [
    // article policy
    Article::class => ArticlePolicy::class,
];
