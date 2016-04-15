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

    public function actionCreateGroup(){
        $group = $this->M('Group');
        $newGroup = $group->creatGroup($this->openId);
        $user = $this->M('User');
    }

    public function actionJoinGroup($groupId){
        $group = $this->M('Group');
        $group->joinGroup($this->openId,$groupId);
    }
}
