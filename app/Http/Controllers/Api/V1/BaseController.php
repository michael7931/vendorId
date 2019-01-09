<?php

namespace App\Http\Controllers\Api\V1;

use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Http\Request;


class BaseController extends Controller {
    // 接口帮助调用
    use Helpers;

    // 返回错误的请求
    protected function errorBadRequest($validator) {
        // github like error messages
        // if you don't like this you can use code bellow
        //
        //throw new ValidationHttpException($validator->errors());

        $result   = [];
        $messages = $validator->errors()->toArray();

        if ($messages) {
            foreach ($messages as $field => $errors) {
                foreach ($errors as $error) {
                    $result[] = [
                        'field' => $field,
                        'code' => $error,
                    ];
                }
            }
        }

        throw new ValidationHttpException($result);
    }

    public function returnSuccessResponse($data = [], $token = [],$mge='') {
        $arr = [
            "status_code" => 0,
            "message" => $mge?$mge:"success",
        ];
        $arr["data"] = $data;
//        if ($token) $arr["tokenInfo"] = $token;
//        return response()->json($arr,200,[],1);

//        $data = [
//            'status_code' => $status_code,
//            'message' => $message,
//        ];
        header("Content-type: application/json");
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        die;
    }

    public function returnErrorResponse($status_code = 0, $message = '') {
        if(!$status_code){
            return '参数异常';
        }

        if( !$message){
            $errorArr = config('errorCode');
            $keys = array_keys($errorArr);
            if (!in_array($status_code, $keys)) {
                return false;
            }
            $message = $errorArr[$status_code];
        }

//        return response()->json([
//            'status_code' => $status_code,
//            'message' => $message,
//        ],200,[],JSON_UNESCAPED_UNICODE);
//        echo $message;
        $data = [
            'status_code' => $status_code,
            'message' => $message,
        ];
        header("Content-type: application/json");
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die;
    }
















}
