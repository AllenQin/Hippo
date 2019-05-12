<?php

use App\Library\Core\Router\Router;

Router::add('userLogin', 'login', 'user@signIn');
Router::add('articleList', 'post-list', 'article@index');
Router::add('articleShow', 'post/:id', 'article@show');

return new Router();
