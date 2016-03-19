<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:49
 */

class controller
{
    protected $app;

    protected $redis;

    //前端展示函数
    protected function show(){

    }

    protected function redis(){
        require_once $_SERVER['DOCUMENT_ROOT'].'/Base/redis.php';
        $redis = new Redis;
        $this->redis = $redis;
    }

}