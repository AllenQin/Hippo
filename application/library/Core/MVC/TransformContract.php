<?php
namespace App\Library\Core\MVC;

use Illuminate\Support\Collection;

interface TransformContract
{
    public function transform(Collection $collection);

    public function transformOne($item);
}
