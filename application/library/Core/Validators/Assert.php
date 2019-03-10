<?php
namespace App\Library\Core\Validators;

class Assert
{
    /* @var Validator $validator */
    protected $validator;

    private $errorMessage;

    public function __construct($container)
    {
        $this->validator = Validator::getInstance($container['config']);
    }

    public function validate($rule, $input, $message = [], $attributes = [], $code = null)
    {
        $this->errorMessage = [];
        if ($this->validator->validator($rule, $input, $message, $attributes)) {
            return true;
        } else {
            $this->errorMessage = $this->validator->getMessages();
            if ($code) {
                throw new \Exception($this->validator->getFirstMessage(), $code);
            } else {
                return false;
            }
        }
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getFirstMessage()
    {
        reset($this->errorMessage);
        return $this->errorMessage ? current($this->errorMessage) : null;
    }

    public function pushErrorMessage($key, $message)
    {
        $this->errorMessage[$key] = $message;
        return $this->validator->pushErrorMessage($key, $message);
    }
}

