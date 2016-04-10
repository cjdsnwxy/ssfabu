<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:49
 */

include $_SERVER['DOCUMENT_ROOT'].'/Controllers/controller.php';

class indexController extends controller
{

    public function actionIndex(){
        $user = $this->M('User');
        $userInfo = $user->getUserInfo($this->openId);
        $this->display('Index/index',array(
            'user' => $userInfo
        ));
    }

    public function actionCreateGroup(){
        $user = $this->M('User');
    }

    public function actionJoinGroup(){

    }
}
