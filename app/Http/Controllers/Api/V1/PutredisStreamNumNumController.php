<?php

namespace App\Http\Controllers\Api\V1;

//use DB;
//use Illuminate\Support\Facades\Redis;
use App\Reorganize\RedisCluster as redis;
use Illuminate\Support\Facades\Log;
use App\Reorganize\StreamNumlogReorganize as snR;

class PutredisStreamNumNumController extends BaseController{

    /**插入链表头部/左侧
     * 订单号插入redis里
     * 键名StreamNum
     */
    public function putRedisStreamNum(){
        $snR = new snR();
        $nums = $snR->getStreamNum();

        $redis = new redis();
        foreach ($nums as $v) {
            $res = $redis->rpush( config('generator.stream_redis_key') , $v['nums']);
            $delIdArr[] = $v['id'];
        }

        if( isset($delIdArr) ){
            $snR->delByid($delIdArr);
        }
    }

    public function checkStreamNum(){
        $redis = new redis();
        $len = $redis->llen('StreamNum');
        return $len?$len:0;
    }



    public function handleStreamNum(){
        $len = $this->checkStreamNum();

        if ($len <= config('generator.stream_redis_len_limit') ){
            $this->putRedisStreamNum();
        }

    }





//    public function putRedisStreamNum(){
//        $snR = new snR();
//        $nums = $snR->getStreamNum();
//
//        $redis = new redis();
//        foreach ($nums as $v) {
//            $redis->lPush('StreamNum', $v['nums']);
//        }
//    }









    
    
    
    
    
    
}
