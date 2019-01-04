<?php

namespace App\Http\Controllers\Api\V1;

//use App\Models\Authorization;
use App\Models\OrderNumlog;
use DB;

class NumlogsController extends BaseController{

    public function generateNum($i = 1){
        $count=config('generator.onestep') ;
//        $i = ($initialNum <= 0)?1:$initialNum;
        $arr = [];
        $amcount = $i+$count;
        for ( $i ;$i < $amcount;$i++) {
            $son['nums'] = $i;
            $arr[] = $son;
        }

        return $arr;
    }



    public function getLastId(){
        $numModel = new OrderNumlog();
        $res = $numModel->orderBy('id','desc')->value('nums');
        return $res?$res:0;
    }

    public function insertDatas($arr = []){
        $numModel = new OrderNumlog();
        $res = $numModel->insert($arr);
        return $res;
    }
    
    public function addOrderNumlogdbIncrementnum(){
        $tableLastId = $this->getLastId();
        $tableLastId = ( $tableLastId == 0)? config('generator.order_init_num') :$tableLastId;
//        pj( $tableLastId ,1);

        $genNumArr = $this->generateNum($tableLastId+1);
//        pj($genNumArr,1);

        $insertRes = $this->insertDatas($genNumArr);

    }


    public function addStreamNumlogdbIncrementnumd() {




        echo 'addStreamNumlogdbIncrementnumd';
    }




}
