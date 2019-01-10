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


    public function xgetGenid(){
        $url = 'http://fh.yilian1.com/genid/1';

//        for ( $i=1 ;$i < 200;$i++) {
            $file_contents  = $this->HttpGet($url);
//        }


//        pj($file_contents,1);
        echo $file_contents;
    }

    public function HttpGet($url){
        $curl = curl_init ();
        curl_setopt ( $curl, CURLOPT_URL, $url );
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
        // curl_setopt ( $curl, CURLOPT_TIMEOUT, 500 );
        // curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36');

        //如果用的协议是https则打开鞋面这个注释
        //curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $res = curl_exec ( $curl );
        curl_close ( $curl );
        return $res;
    }





}
