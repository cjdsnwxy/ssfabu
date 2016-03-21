<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:49
 */

class controller
{
    public $app;

    public $redis;

    public $model;

    //访问View层函数
    public function show($path,$param){

    }

    //调用redis缓存函数
    protected function redis(){
        require_once $_SERVER['DOCUMENT_ROOT'].'/Base/redis.php';
        $redis = new Redis;
        $this->redis = $redis;
    }

    //访问model层函数
    public function M($model){
        include $_SERVER['DOCUMENT_ROOT'].'/Models/'.$model.'.php';
        return new $model;
    }
}