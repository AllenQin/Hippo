<?php
namespace App\Library\Core\Validators;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\MessageBag;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

class Validator
{
    public static $_instance = null;

    private $validator;

    private $message;

    /* @var MessageBag $messageBag */
    private $messageBag;

    private function __construct($config)
    {
        $translationLoader = new FileLoader(new Filesystem(), $config['validator']['language_path']);
        $this->validator = new Factory(new Translator($translationLoader, $config['validator']['language']));
    }

    public static function getInstance($config)
    {
        if (null == self::$_instance) {
            self::$_instance = new Validator($config);
        }

        return self::$_instance;
    }

    /**
     * validator data use define rule
     *
     * @param $rule
     * @param $data
     * @param array $messages
     * @param array $attributes
     * @return bool
     */
    public function validator($rule, $data, $messages = [], $attributes = [])
    {
        $this->message = null;
        $validator = $this->validator->make($data, $rule, $messages, $attributes);
        if ($validator->fails()) {
            $this->messageBag = $validator->messages();
            $this->message = $this->messageBag->all();
            return false;
        }

        return true;
    }

    /**
     * Get all error message
     *
     * @return mixed
     */
    public function getMessages()
    {
        return $this->message;
    }

    /**
     * Get first error message
     *
     * @param null $key
     * @return string
     */
    public function getFirstMessage($key = null)
    {
        return $this->messageBag->first($key);
    }

    private function __clone()
    {

    }

    private function __sleep()
    {

    }
}