<?php

namespace App\Http\Controllers\Api\V1;

//use App\Models\Authorization;
use App\Models\OrderNumlog;
use DB;
use App\Reorganize\OrderNumlogReorganize as onR;
use App\Reorganize\StreamNumlogReorganize as snR;

class GeneratorController extends BaseController{

    public function addOrderNumlogdbIncrementnum(){
        $orn = new onR();
        $orn->addOrderNumlogdbIncrementnum();
    }


    public function addStreamNumlogdbIncrementnumd() {
        $snR = new snR();
        $snR->addStreamNumlogdbIncrementnum();
    }






}
