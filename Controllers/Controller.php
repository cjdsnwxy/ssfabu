<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:49
 */
class Controller
{

    public $openId;

    public $app;

    public $model;

    function __construct(){
        $this->openId = '111111';
    }

    //访问View层函数
    public function display($path){
        include $_SERVER['DOCUMENT_ROOT'].'/Views/'.$path.'.php';
    }

    //调用redis缓存函数
    protected function redis(){
        include $_SERVER['DOCUMENT_ROOT'].'/Base/redis.php';
        return new Redis;
    }

    //访问model层函数
    public function M($model){
        include $_SERVER['DOCUMENT_ROOT'].'/Models/'.$model.'.php';
        return new $model;
    }
}