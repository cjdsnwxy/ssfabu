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
    public function actionIndex(){
        $this->display('Index/index');
    }

    public function actionQrcode(){
        include $_SERVER['DOCUMENT_ROOT'].'/Ext/phpqrcode.php';
        QRcode::png('http://www.baidu.com/');
        //http://127.0.0.1/index.php?c=index&a=qrcode

    }
}
