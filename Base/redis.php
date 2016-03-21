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
        $conf = include 'conf.php';
        $redis = new Redis();
        $redis->connect($conf['redis']['host'],$conf['redis']['port']);
        $this->redis = $redis;
    }

    public function demo(){
        ;
    }

    public function set($key,$value){
        $this->redis->set($key,$value);
    }

    public function get($key){
        return $this->redis->get($key);
    }
}