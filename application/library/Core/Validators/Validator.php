<?php
namespace App\Library\Core\Validators;

use App\Library\Core\Di\InjectionWareInterface;
use App\Library\Core\Di\InjectionWareTrait;
use Illuminate\Validation\Factory;

class Validator extends Factory implements InjectionWareInterface
{
    use InjectionWareTrait;
    private static $message = 'ok';
    private static $headers = [
            'e' => 'rules/data is empty',
            'na' => 'rules/data is not a array'
    ];

    /***
     * 创建实例
     *
     * @return \Illuminate\Validation\Factory
     */
    public static function getInstance()
    {
        static $validator = null;
        if ($validator === null) {
            $test_translation_path = __DIR__ . '/lang';
            $test_translation_locale = 'en';
            $translation_file_loader = new \Illuminate\Translation\FileLoader(new \Illuminate\Filesystem\Filesystem, $test_translation_path);
            $translator = new \Illuminate\Translation\Translator($translation_file_loader, $test_translation_locale);
            $validator = new \Illuminate\Validation\Factory($translator);
        }
        return $validator;
    }

    /**
     * @param array $rules 验证规则
     * @param array $data 验证数据
     * @return bool
     */
    public static function validators($rules = [], $data = [])
    {
        if (empty($rules) || empty($data)) {
            self::$message = self::$headers['e'];
            return false;
        }
        if (is_array($rules) && is_array($data)) {
            $v = self::vmake($rules, $data);
            if ($v->fails()) {
                self::$message = $v->messages();
                return false;
            }
            return true;
        }
        self::$message = self::$headers['na'];
        return false;
    }

    /**
     * 验证实例
     * @param $rules
     * @param $data
     * @return \Illuminate\Validation\Validator
     */
    private static function vmake($rules, $data)
    {
        $v = self::getInstance()->make($data, $rules);
        return $v;
    }

    /**
     * 获取错误消息
     * @return string
     */
    public static function getMessage()
    {
        return self::$message;
    }
}
