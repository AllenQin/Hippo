<?php
namespace App\Library\Core\Validators;

use App\Defines\OuterCode;
use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use App\Library\Core\Validators\Validator;

class Assert implements InjectionWareInterface
{
    use InjectionWareTrait;

    /* @var Validator $validator */
    protected $validator;

    public function __construct($container)
    {
        $this->validator = Validator::getInstance($container['config']);
    }

    public function validate($rule, $input, $message = [], $attributes = [], $code = OuterCode::PARAMETER_ERROR)
    {
        if ($this->validator->validator($rule, $input, $message, $attributes)) {
            return true;
        } else {
            if ($code) {
                throw new \Exception($this->validator->getFirstMessage(), $code);
            } else {
                return $this->validator->getFirstMessage();
            }
        }
    }

    public function getValidator()
    {
        return $this->validator;
    }
}

