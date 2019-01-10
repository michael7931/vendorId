<?php

namespace App\Http\Controllers\Api\V1;

//use DB;
//use Illuminate\Support\Facades\Redis;
use App\Reorganize\OrderNumlogReorganize as onR;
use App\Reorganize\RedisCluster as redis;
use Illuminate\Support\Facades\Log;

class PutredisOrderNumController extends BaseController{

    /**
     * 订单号插入redis里
     * 键名orderNum
     */
    public function putRedisOrderNum(){
        $onR = new onR();
        $nums = $onR->getOrderNum();

        $redis = new redis();
        foreach ($nums as $v) {
            $res = $redis->rpush( config('generator.order_redis_key') , $v['nums']);
            $delIdArr[] = $v['id'];
        }

        if( isset($delIdArr) ){
            $onR->delByid($delIdArr);
        }
    }

    public function checkOrderNum(){
        $redis = new redis();
        $len = $redis->llen('orderNum');
        return $len?$len:0;
    }



    public function handleOrderNum(){
        $len = $this->checkOrderNum();

        if ($len <= config('generator.order_redis_len_limit') ){
            $this->putRedisOrderNum();
        }
    }










    
    
    
    
    
    
}
