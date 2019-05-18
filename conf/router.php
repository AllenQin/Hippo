<?php

use App\Library\Core\Router\Router;

Router::add('userLogin', 'login', 'user@signIn');
Router::add('articleList', 'post-list', 'article@index');
Router::add('articleShow', 'post/:id', 'article@show');
Router::add('introduction', 'introduction', 'introduction@index');

return new Router();
