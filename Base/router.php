<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:45
 * 路由控制函数
 */

//获得控制器和方法

$c_str = $_GET['c'] ? $_GET['c'] : 'index';
$a_str = $_GET['a'] ? $_GET['a'] : 'index';

//组装控制器名和方法名
$c_name = $c_str.'Controller';
$a_name = 'action'.ucfirst($a_str);
$path = './Controllers/'.$c_name.'.php';

//判断合法性
if(!include_once $path){
    defaultIndex();
}else{
    $con = new $c_name;
    if(method_exists($con,$a_name)){
        $con->$a_name();
    }else{
        defaultIndex();
    }
}

//默认控制器和方法
function defaultIndex(){
    include_once './Controllers/indexController.php';
    $con = new indexController;
    $con->actionIndex();
}
