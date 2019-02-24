<?php
namespace App\Library\Core\Auth;

abstract class IdentityAbstract
{
    abstract public function getUserInfo();
    abstract public function getRememberMe();
}
