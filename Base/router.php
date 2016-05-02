<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:45
 * 路由控制函数
 */

//获得Url的控制器和方法

$c_str = isset($_GET['c']) ? $_GET['c'] : 'index';
$a_str = isset($_GET['a']) ? $_GET['a'] : 'index';

//拼接控制器名和方法名
$c_name = $c_str.'Controller';
$a_name = 'action'.ucfirst($a_str);
$path = $_SERVER['DOCUMENT_ROOT'].'/Controllers/'.$c_name.'.php';

//判断合法性
if(@!include $path){
    include $_SERVER['DOCUMENT_ROOT'].'/Controllers/indexController.php';
    defaultIndex();
}else{
    $con = new $c_name();

    if(false == method_exists($con,$a_name)){
        defaultIndex();
    }else{
        $con->$a_name();
    }
}
//默认控制器和方法
function defaultIndex(){
    echo $_SERVER['DOCUMENT_ROOT'].'/Controllers/indexController.php';
    $con = new indexController();
    $con->actionIndex();
}
