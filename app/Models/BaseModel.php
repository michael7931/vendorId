<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
    protected $guarded = ['id'];

    protected $hidden = ['deleted_at', 'extra'];


//    public function addAll(Array $data) {
//        $rs = DB::table($this->getTable())->insert($data);
//        return $rs;
//    }


}
