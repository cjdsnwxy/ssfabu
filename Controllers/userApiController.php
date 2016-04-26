<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-4-15
 * Time: 下午3:33
 */
include $_SERVER['DOCUMENT_ROOT'].'/Controllers/Controller.php';
class userApiController extends Controller
{
    //ajax获取我加入的群组
    public function actionGetJoinGroup(){
        $user = $this->M('User');
        $groupList = $user->getJoinGroup($this->openId);
        if(empty($groupList['joinGroup']))
        {
            $this->renderErr('没有加入过群组');
            return;
        }
        $group = $this->M('Group');
        $list = $group->getGroupNameById($groupList['joinGroup']);
        if(empty($list))
        {
            $this->renderErr('没有加入过群组');
            return;
        }
        $this->renderAjax($list);
    }

    //ajax获取我创建的群组
    public function actionGetCreateGroup(){
        $user = $this->M('User');
        $groupList = $user->getuserInfo($this->openId);
        if(empty($groupList['createGroup']))
        {
            $this->renderErr('没有创建过群组');
            return;
        }
        $group = $this->M('Group');
        $list = $group->getGroupNameById($groupList['createGroup']);
        $this->renderAjax($list);
    }
}