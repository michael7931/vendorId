<?php

namespace App\Reorganize;

use Illuminate\Support\Facades\Redis;

/**
 * Redis 操作，支持 Master/Slave 的负载集群
 */
class RedisCluster{


    /**
     * 写缓存
     *
     * @param string $key 组存KEY
     * @param string $value 缓存值
     * @param int $expire 过期时间， 0:表示无过期时间
     */
    public function set($key, $value, $expire=0){
        // 永不超时
        if($expire == 0){
            $ret = Redis::set($key, $value);
        }else{
            $ret = Redis::setex($key, $expire, $value);
        }
        return $ret;
    }

    /**
     * 读缓存
     *
     * @param string $key 缓存KEY,支持一次取多个 $key = array('key1','key2')
     * @return string || boolean  失败返回 false, 成功返回字符串
     */
    public function get($key){

        return Redis::get($key);
    }


    public function setnx($key, $value){
        return Redis::setnx($key, $value);
    }

    /**
     * 删除缓存
     *
     * @param string || array $key 缓存KEY，支持单个健:"key1" 或多个健:array('key1','key2')
     * @return int 删除的健的数量
     */
    public function remove($key){
        // $key => "key1" || array('key1','key2')
        return Redis::delete($key);
    }

    /**
     * 值加加操作,类似 ++$i ,如果 key 不存在时自动设置为 0 后进行加加操作
     *
     * @param string $key 缓存KEY
     * @param int $default 操作时的默认值
     * @return int　操作后的值
     */
    public function incr($key,$default=1){
        if($default == 1){
            return Redis::incr($key);
        }else{
            return Redis::incrBy($key, $default);
        }
    }

    /**
     * 值减减操作,类似 --$i ,如果 key 不存在时自动设置为 0 后进行减减操作
     *
     * @param string $key 缓存KEY
     * @param int $default 操作时的默认值
     * @return int　操作后的值
     */
    public function decr($key,$default=1){
        if($default == 1){
            return Redis::decr($key);
        }else{
            return Redis::decrBy($key, $default);
        }
    }

    /**
     * 添空当前数据库
     *
     * @return boolean
     */
    public function clear(){
        return Redis::flushDB();
    }



    //-----------------list链表操作---------------------------
    /**
     *    lpush
     */
    public function lpush($key,$value){
        return Redis::lpush($key,$value);
    }

    public function rpush($key,$value){
        return Redis::rpush($key,$value);
    }


    /**
     *    add lpop
     */
    public function lpop($key){
        return Redis::lpop($key);
    }
    /**
     * lrange
     */
    public function lrange($key,$start,$end){
        return Redis::lrange($key,$start,$end);
    }

    public function llen($key){
        return Redis::LLEN($key);
    }

    public function rpop($key){
        return Redis::rpop($key);
    }




    //-----------------list链表操作END---------------------------







    /**
     *    set hash opeation
     */
    public function hset($name,$key,$value){
        if(is_array($value)){
            return Redis::hset($name,$key,serialize($value));
        }
        return Redis::hset($name,$key,$value);
    }
    /**
     *    get hash opeation
     */
    public function hget($name,$key = null,$serialize=true){
        if($key){
            $row = Redis::hget($name,$key);
            if($row && $serialize){
                unserialize($row);
            }
            return $row;
        }
        return Redis::hgetAll($name);
    }

    /**
     *    delete hash opeation
     */
    public function hdel($name,$key = null){
        if($key){
            return Redis::hdel($name,$key);
        }
        return Redis::hdel($name);
    }
    /**
     * Transaction start
     */
    public function multi(){
        return Redis::multi();
    }
    /**
     * Transaction send
     */

    public function exec(){
        return Redis::exec();
    }



}