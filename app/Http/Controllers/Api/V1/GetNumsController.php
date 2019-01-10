<?php

namespace App\Http\Controllers\Api\V1;

use App\Reorganize\RedisCluster as redis;
use App\Reorganize\OrderNumlogReorganize as onR;
use App\Reorganize\StreamNumlogReorganize as snR;

class GetNumsController extends BaseController{

    public function getGenidd(){
        echo 'asg111';exit;

    }

    public function getGenid($type){

        $redis = new redis();

        switch($type){
            case 1: //订单号码出栈
                $num = $redis->lpop(  config('generator.order_redis_key')  );
                if(empty($num)){
                    $this->returnErrorResponse(4000,'号码不足，请联系管理员补充号码。邮件2230538502@qq.com');
                }
                $orderNumsModel = new onR();
//                $orderNumsModel->delByNums($num);
                $this->returnSuccessResponse($num);
                break;
            case 2:
                $num = $redis->lpop(  config('generator.stream_redis_key')  );
                if(empty($num)){
                    $this->returnErrorResponse(4000,'号码不足，请联系管理员补充号码。邮件2230538502@qq.com');
                }
                $streamNumsModel = new snR();
//                $streamNumsModel->delByNums($num);
                $this->returnSuccessResponse($num);
                break;
            default:
                $this->returnErrorResponse(4001,'参数不正确');
                break;
        }





//        echo 'getGenid';
    }









}
