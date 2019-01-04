<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SoftDelete;


class StreamNumlog extends BaseModel {

//    public $timestamps = false;

    protected $fillable = ['nums'];


//    public function fromDateTime($value) {
//        return strtotime(parent::fromDateTime($value));
//    }


//    protected $dateFormat = 'U';


//    use SoftDelete;

    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }


}
