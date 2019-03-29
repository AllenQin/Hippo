<?php

use App\Library\Core\Router\Router;

Router::add('userLogin', 'login', 'user@signIn');

return new Router();
