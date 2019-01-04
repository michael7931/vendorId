<?php

namespace App\Reorganize;

use App\Models\StreamNumlog;
use DB;


class StreamNumlogReorganize extends BaseReorganize {

    public function generateNum($i = 1) {
        $count = config('generator.streamdb_onestep');

        $arr     = [];
        $amcount = $i + $count;
        for ($i; $i < $amcount; $i++) {
            $son['nums'] = $i;
            $son['created_at'] = time();
            $son['updated_at'] = time();
            $arr[]       = $son;
        }

        return $arr;
    }

    public function getLastId() {
        $numModel = new StreamNumlog();
        $lastId   = $numModel->orderBy('id', 'desc')->value('id');//sure
        return $lastId ? $lastId : 0;
    }


    public function insertDatas($arr = []) {
        $numModel = new StreamNumlog();
        $res      = $numModel->insert($arr);
        return $res;
    }

    public function addStreamNumlogdbIncrementnum() {
        $tableLastId = $this->getLastId();
        $insertNum = config('generator.stream_init_num') + $tableLastId;
        $genNumArr = $this->generateNum( $insertNum );
        $insertRes = $this->insertDatas($genNumArr);
    }


    /**
     * 获取流水号码
     */
    public function getStreamNum() {
        $numModel   = new StreamNumlog();
        $takeAmount = config('generator.stream_onestep');
        $list = $numModel->where('nums', '!=', 0)->where('deleted_at','=',0)
                ->orderBy('id', 'asc')->take($takeAmount)->get();

        return $list ? $list->toArray() : [];
    }

    /**删除
     * @param array $arr
     * @return bool
     */
    public function delByid($arr = []) {
        if (!is_array($arr)) return false;
        $numModel = new StreamNumlog();

        foreach ($arr as $value) {
            $updata = [
                'updated_at' => time(),
                'deleted_at' => time(),
            ];
            $res      = $numModel->where('id','=', $value)->update($updata);
        }


        return $res ? $res : false;
    }





}