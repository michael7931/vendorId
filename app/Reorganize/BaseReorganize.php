<?php

namespace App\Reorganize;

use DB;
use Log;

class BaseReorganize{
    public function __construct(){
        DB::connection()->enableQueryLog();
    }

    public function getLastSql(){
        $sql = DB::getQueryLog();
        $query = end($sql);
        $tmp = str_replace('?', '"'.'%s'.'"', $query["query"]);
        $query['query'] = vsprintf($tmp, $query['bindings']);
        unset( $query['bindings']);
        $query['time'] = $query['time']/1000;
        return $query;
    }


    public function beginTransaction(){
        DB::beginTransaction(); //开启事务
    }

    public function dbrollback(){
        DB::rollback();
    }

    public function dbcommit(){
        DB::commit();
    }


    public function wxlog($message=''){
        Log::INFO($message);
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
//        else{
//            $message = '访问失败';
//        }

        return response()->json([
            'status_code' => $status_code,
            'message' => $message,
        ],200,[],JSON_UNESCAPED_UNICODE);
        die;
    }




}
