<?php

use App\Library\Core\MVC\ApiController;

class UserController extends ApiController
{
    public function listAction()
    {
        $user = [
            ['name' => 'allenqin', 'age' => 30],
            ['name' => 'tom', 'age' => 28],
        ];

        return $this->success($user);
    }
}
