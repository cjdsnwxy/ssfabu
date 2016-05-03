<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午6:00
 */
class redisClass
{
    private $redis;

    function __construct(){
        $redis = new Redis();
        $redis->connect(REDIS_HOST,REDIS_PORT);
        $this->redis = $redis;
    }

    public function redisSet($key,$value){
       return $this->redis->set($key,$value);
    }

    public function redisGet($key){
        return $this->redis->get($key);
    }
}