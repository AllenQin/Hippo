<?php
namespace App\Library\Core\Auth;

interface UserInterface
{
    public function getUid();

    public function getToken();

    public function getUserData();
}
