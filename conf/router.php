<?php

use App\Library\Core\Router\Router;

Router::add('userLogin', 'login', 'user@signIn');
Router::add('articleShow', 'article/show/:id', 'article@show');

return new Router();
