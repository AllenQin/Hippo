<?php
namespace App\Library\Core\Validators;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;

class Assert implements InjectionWareInterface
{
    use InjectionWareTrait;

    public function validate($rule, $input, $message = [], $attributes = [])
    {
        if (Validator::validators($rule, $input)) {
            return true;
        } else {
            throw new \Exception(Validator::getMessage(), 1);
        }
    }
}

