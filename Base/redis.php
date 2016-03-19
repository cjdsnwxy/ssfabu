<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午6:00
 */
include_once 'base.php';
class redisClass extends base
{
    private $con;

    function __construct(){
        $conf = include 'conf.php';
        $redis = new Redis();
        $this->con = $redis->connect($conf['redis']['host'],$conf['redis']['port']);
    }

    public function demo(){
        echo 'redis';
    }
}