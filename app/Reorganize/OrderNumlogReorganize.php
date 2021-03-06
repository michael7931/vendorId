<?php

namespace App\Reorganize;
use App\Models\OrderNumlog;
use DB;


class OrderNumlogReorganize extends BaseReorganize {

    /**生成号码
     * @param int $i
     * @return array
     */
    public function generateNum($i = 1){
        $count=config('generator.orderdb_onestep') ;
        $arr = [];
        $amcount = $i+$count;
        for ( $i ;$i < $amcount;$i++) {
            $son['nums'] = $i;
            $son['created_at'] = time();
            $son['updated_at'] = time();
            $arr[] = $son;
        }

        return $arr;
    }



    public function getLastId(){
        $numModel = new OrderNumlog();
        $lastId   = $numModel->orderBy('id', 'desc')->value('id');//sure
        return $lastId?$lastId:0;
    }

    public function insertDatas($arr = []){
        $numModel = new OrderNumlog();
        $res = $numModel->insert($arr);
        return $res;
    }

    public function addOrderNumlogdbIncrementnum(){
        $extCount = $this->countEcDel();
        $lenLimit = config('generator.orderdb_len_limit');

        if ( $extCount <= $lenLimit ){
            $tableLastId = $this->getLastId();
            $insertNum = config('generator.order_init_num') + $tableLastId;
            $genNumArr = $this->generateNum($insertNum);
            $insertRes = $this->insertDatas($genNumArr);
        }

    }


    public function countEcDel(){
        $numModel = new OrderNumlog();
        $count = $numModel->where('deleted_at','=',0)->count();
        return $count?$count:0;
    }


    /**
     * 获取订单号码
     */
    public function getOrderNum(){
        $numModel = new OrderNumlog();
        $takeAmount = config('generator.order_redis_onestep');
//        $list = $numModel->orderBy('id','asc')->take($takeAmount)->get();
        $list = $numModel->where('nums', '!=', 0)->where('deleted_at','=',0)
            ->orderBy('id', 'asc')->take($takeAmount)->get();
        return $list?$list->toArray():[];
    }

    /**删除
     * @param array $arr
     * @return bool
     */
    public function delByid($arr=[]){
        if (  !is_array($arr) ) return false;
        $numModel = new OrderNumlog();
        foreach ($arr as $value) {
            $updata = [
                'updated_at' => time(),
                'deleted_at' => time(),
            ];
            $res      = $numModel->where('id','=', $value)->update($updata);
        }

        return $res?$res:false;
    }

    public function delByNums($nums){
        if (!$nums) return false;
        $updata = [
            'updated_at' => time(),
            'deleted_at' => time(),
        ];
        $numModel = new OrderNumlog();
        $res      = $numModel->where('nums','=', $nums)->update($updata);
    }



    
}