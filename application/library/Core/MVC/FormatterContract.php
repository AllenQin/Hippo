<?php
namespace App\Library\Core\MVC;

use Illuminate\Support\Collection;

interface FormatterContract
{
    public function format(Collection $collection);

    public function formatOne($item);
}
