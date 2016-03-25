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
        $userInfo = $this->M('User');
        $user = $userInfo->getUserInfo('111111');
        $createGroup = $userInfo->getCreateGroup('111111');
        $joinGroup = $userInfo->getJoinGroup('111111');
        $this->display('Index/index',array(
            'user' => $user,
            'createGroup' => $createGroup,
            'joinGroup' => $joinGroup
        ));
    }
}
