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

    //获取二维码
    public function actionQrcode(){
        include $_SERVER['DOCUMENT_ROOT'].'/Ext/phpqrcode.php';
        QRcode::png('http://www.baidu.com/');
        //http://127.0.0.1/index.php?c=index&a=qrcode
    }

    public function actionShowMsg(){
        echo 'sss';
        if(empty($_GET['msgId'])){
            $this->display('Index/index');
        }else{
            $msgId = $_GET['msgId'];
            $msg = $this->M('Message');
            $msgInfo = $msg->getMsgInfo($msgId);
            $this->display('Index/message',$msgInfo);
        }
    }
}
