<?php

return [

    'order_init_num' => env('ORDER_INIT_NUM', 1), //订单号初始值
    'order_redis_key' => env('ORDER_REDIS_KEY', 'order_num'), //redis的key
    'order_len_limit' => env('ORDER_LEN_LIMIT', 100), //每次检查redis，长度小于此值追加
    'order_onestep' => env('ORDER_ONESTEP', 10), //每次插入redis号码的数量
    'orderdb_onestep' => env('ORDERDB_ONESTEP', 12), //每次插入数据库order_numlogs号码的数量


    'stream_init_num' => env('STREAM_INIT_NUM', 1),//流水号码初始值
    'stream_redis_key' => env('STREAM_REDIS_KEY', 'stream_num'), //redis的key
    'stream_len_limit' => env('STREAM_LEN_LIMIT', 100), //每次检查redis，长度小于此值追加
    'stream_onestep' => env('STREAM_ONESTEP', 10), //每次插入redis号码的数量
    'streamdb_onestep' => env('STREAMDB_ONESTEP', 12), //每次插入数据库stream_numlogs号码的数量


];
