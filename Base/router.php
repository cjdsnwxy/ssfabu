<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/26
 * Time: 16:05
 */

//获取所有请求如果则自动转到index/index
$request = $_SERVER['QUERY_STRING'];

//解析$request变量，得到访问链接的参数
$parsed = explode('&' , $request);
$getVars = array();
foreach ($parsed as $argument)
{
    //用"="分隔字符串，左边为变量，右边为值
    @list($variable , $value) = explode('=' , $argument);
    $getVars[$variable] = $value;
}

//拼接控制器名和方法名
@$getVars['c'] = $getVars['c'] ? $getVars['c'] : 'index';
@$getVars['a'] = $getVars['a'] ? $getVars['a'] : 'index';
$c_name = $getVars['c'].'Controller';
$a_name = 'action'.ucfirst($getVars['a']);

if(isset($getVars['state']) && $getVars['state'] != 'STATE'){
    $a_name = 'actionMsg';
}

//构成控制器文件路径
$path = SERVER_ROOT . '/Controller/' . $c_name . '.php';

//引入目标文件
if (file_exists($path))
{
    include $path;

    //初始化对应的类
    if (class_exists($c_name))
    {
        $controller = new $c_name;
        @$controller->$a_name();
    }
    else
    {
        //类的命名正确吗？
        die('class does not exist!');
    }
}
else
{
    //不能在controllers找到此文件
    die('page does not exist!');
}

function __autoload($className){
    //$file = SERVER_ROOT . '/Model/' .$modelName. '.php';
    if($className == 'Controller'){
        $file = SERVER_ROOT . '/Controller/Controller.php';
        include $file;
    }else if($className == 'Model'){
        $file = SERVER_ROOT . '/Model/Model.php';
        include $file;
    }else{
        $modelFile = SERVER_ROOT . '/Model/' .$className. '.php';
        if(file_exists($modelFile)){
            include $modelFile;
        }
    }
}