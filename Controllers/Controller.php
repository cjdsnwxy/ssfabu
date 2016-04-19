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

    function __construct(){
        $this->openId = '111111';
    }

    //调用redis缓存函数
    protected function redis(){
        include $_SERVER['DOCUMENT_ROOT'].'/Base/redis.php';
        return new redisClass();
    }

    //访问Controller层函数
    public function C($controller){
        include $_SERVER['DOCUMENT_ROOT'].'/Controller/'.$controller.'.php';
        $controller = 'action'.ucfirst($controller);
        return new $controller;
    }

    //访问Model层函数
    public function M($model){
        include $_SERVER['DOCUMENT_ROOT'].'/Models/'.$model.'.php';
        return new $model;
    }

    //访问View层函数
    public function display($path){
        include $_SERVER['DOCUMENT_ROOT'].'/Views/'.$path.'.php';
    }
}