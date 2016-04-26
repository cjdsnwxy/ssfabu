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
        $this->openId = '3';
        $user = $this->M('User');
        $user->createUser($this->openId);
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
        include_once $_SERVER['DOCUMENT_ROOT'].'/Models/'.$model.'.php';
        return new $model;
    }

    //访问View层函数
    public function display($path){
        include $_SERVER['DOCUMENT_ROOT'].'/Views/'.$path.'.php';
    }

    //ajax返回JSON数据
    public function renderAjax($obj = null){
        $json = [
            'ok' => 0
        ];
        if (isset($obj)) {
            $json['obj'] = $obj;
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    //ajax返回error数据
    public function renderErr($error = ""){
        $json = [
            'error' => 0,
            'msg' =>$error
        ];
        echo json_encode($json);
    }
}