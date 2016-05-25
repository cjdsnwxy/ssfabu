<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:49
 */

include $_SERVER['DOCUMENT_ROOT'].'/Controllers/Controller.php';
class indexController extends Controller
{
    //显示indexPage
    public function actionIndex(){
       $this->display('Index/index');
    }

    //显示消息page
    public function actionShowMsg($msgId){
        $massage = $this->M('Message');
        $msg = $massage->getMsgInfo($msgId);
        var_dump($msg);
    }
}
