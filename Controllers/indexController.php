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
        $groupName = $_POST['groupName'];
        $intro = $_POST['intro'];
        $group = $this->M('Group');
        $groupId = $group->createGroup($this->openId,$groupName,$intro);
        $user = $this->M('User');
        $user->createGroup($this->openId,$groupId);
        $obj = array(
            'groupId' => $groupId,
        );
        $this->renderAjax($obj);
    }

}
