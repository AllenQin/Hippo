<?php
namespace App\Library\Core\MVC;

use App\Defines\OuterCode;

Trait ApiTrait
{
    /**
     * 请求成功 json返回
     * @param $data
     */
    public function success($data = []) {
        header('Content-type:text/json;charset=utf-8');
        echo json_encode([
            'code' => OuterCode::SUCCESS,
            'data' => $data,
            'msg' => ''
        ]);

        return true;
    }

    /**
     * 请求失败 json返回
     * @param $errorCode
     * @param $errorMsg
     */
    public function error($errorCode, $errorMsg)
    {
        header('Content-type:text/json;charset=utf-8');
        echo json_encode([
            'code' => $errorCode,
            'data' => [],
            'msg' => $errorMsg
        ]);

        return true;
    }
}
