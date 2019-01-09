<?php

namespace App\Http\Controllers\Api\V1;

use App\Reorganize\RedisCluster as redis;
use App\Reorganize\OrderNumlogReorganize as onR;
use App\Reorganize\StreamNumlogReorganize as snR;

class GetNumsController extends BaseController{


    public function getGenid($type){

        switch($type){
            case 1: //订单号码出栈
                $redis = new redis();
                $num = $redis->lpop(  config('generator.order_redis_key')  );
                if(empty($num)){
                    $this->returnErrorResponse(4000,'号码不足，请联系管理员补充号码。邮件2230538502@qq.com');
                }
                $orderNumsModel = new onR();
                $orderNumsModel->delByNums($num);
                $this->returnSuccessResponse($num);
                break;
            case 2:
                echo '222';

                break;
            default:
                echo 'asf';
        }





//        echo 'getGenid';
    }









}
