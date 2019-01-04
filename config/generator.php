<?php

return [

    'order_init_num' => 1, //订单号初始值
    'order_redis_key' => 'order_num', //redis的key
    'order_len_limit' => 100, //每次检查redis，长度小于此值追加
    'order_onestep' => 10, //每次插入redis号码的数量
    'orderdb_onestep' => 12, //每次插入数据库order_numlogs号码的数量


    'stream_init_num' => 1,//流水号码初始值
    'stream_redis_key' => 'stream_num', //redis的key
    'stream_len_limit' => 100, //每次检查redis，长度小于此值追加
    'stream_onestep' => 10, //每次插入redis号码的数量
    'streamdb_onestep' => 12, //每次插入数据库stream_numlogs号码的数量



];
