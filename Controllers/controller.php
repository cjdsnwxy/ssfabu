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

    public $model;

    //访问View层函数
    public function display($path,$param){
        extract($param);
        ob_end_clean (); //关闭顶层的输出缓冲区内容
        ob_start ();     // 开始一个新的缓冲区
        include $_SERVER['DOCUMENT_ROOT'].'/Views/'.$path.'.php';
        $content = ob_get_contents ();             // 获得缓冲区的内容
        ob_end_clean ();           // 关闭缓冲区
        ob_start();            //开始新的缓冲区，给后面的程序用
        echo $content;       // 返回文本，此处也可以字节echo出来，并结束代码。
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