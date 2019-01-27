<?php
namespace App\Library\Core\Queue;

interface IJob
{
    public function perform();
}
