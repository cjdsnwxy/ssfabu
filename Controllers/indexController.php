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

    public function actionCreateGroup(){
        $groupName = "嵌入式软件12-01班";
        $intro = "班级联络通知群";
        $group = $this->M('Group');
        $groupId = $group->createGroup($this->openId,$groupName,$intro);
        $user = $this->M('User');
        $rew  = $user->createGroup($this->openId,$groupId);

    }

    public function actionDemo(){
        
    }
}
