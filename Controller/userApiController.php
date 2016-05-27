<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/26
 * Time: 23:50
 */
class userApiController extends Controller
{
    //ajax获取我加入的群组
    public function actionGetJoinGroup(){
        $user = new User();
        $groupList = $user->getJoinGroup($this->openId);
        if(empty($groupList['joinGroup']))
        {
            $this->renderErr('没有加入过群组');
            return;
        }
        $group = new Group();
        $list = $group->getGroupNameByIdList($groupList['joinGroup']);
        if(empty($list))
        {
            $this->renderErr('没有加入过群组');
            return;
        }
        $this->renderAjax($list);
    }

    //ajax获取我创建的群组
    public function actionGetCreateGroup(){
        $user = new User();
        $groupList = $user->getUserInfo($this->openId);
        if(empty($groupList['createGroup']))
        {
            $this->renderErr('没有创建过群组');
            return;
        }
        $group = new Group();
        $list = $group->getGroupNameByIdList($groupList['createGroup']);
        $this->renderAjax($list);
    }
}