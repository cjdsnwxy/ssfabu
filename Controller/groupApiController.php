<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/27
 * Time: 0:01
 */
class groupApiController extends Controller
{


    //创建群组
    public function actionCreateGroup(){
        $groupName = $_POST['groupName'];
        $intro = $_POST['intro'];
        $group = new Group();
        $groupId = $group->createGroup($this->openId,$groupName,$intro);
        $user = new User();
        $user->createGroup($this->openId,$groupId);
        $obj = array(
            'groupId' => $groupId,
        );
        $this->logSave('createGroup',$groupId);
        $this->renderAjax($obj);
    }

    //加入群组
    public function actionJoinGroup(){
        $groupId = $_POST['groupId'];
        $name = $_POST['name'];
        $group = new Group();
        $user = new User();
        if($group->checkIsCreate($groupId,$this->openId)){
            $this->renderErr("您是群主");
            die;
        }
        if($group->checkInGroup($groupId,$this->openId)){
            $this->renderErr("您已经在群组中.");
            die;
        }
        $group->joinGroup($groupId,$this->openId,$name);
        $user->joinGroup($this->openId,$groupId);
        $this->renderAjax();
    }

    //查找群组
    public function actionFindGroup(){
        $groupId = $_POST['groupId'];
        // $groupId =  "00000001";
        $group = new Group();
        $groupInfo = $group->findGroupInfo($groupId);
        if($groupInfo == null){
            $this->renderErr("查无此群");
            exit;
        }else{
            $obj = array(
                'groupId' => $groupId,
                'groupName' => $groupInfo['groupName'],
                'createTime' => date('Y-m-d',strtotime($groupInfo['createTime'])),
                'groupNum' => $groupInfo['groupNum'],
                'groupIntro' => $groupInfo['groupIntro']
            );
            $this->renderAjax($obj);
        }
    }

    //修改群组
    public function actionUpdateGroup(){
        $groupId = $_POST['groupId'];
        $groupName = $_POST['groupName'];
        $intro = $_POST['intro'];
        $group = new Group();
        if($group->checkIsCreate($groupId,$this->openId)){
            $group->updateGroup($groupId,$groupName,$intro);
            $this->logSave('updateGroup',$groupId);
            $this->renderAjax();
        }else{
            $this->renderErr('您没有权限');
        }
    }

    //解散群组
    public function actionDropGroup(){
        $groupId = $_POST['groupId'];
        //验证是否是创建人
        $user = new User();
        if($user->checkIsCreate($this->openId,$groupId)){
            $res = $user->dropGroup($this->openId,$groupId);
            $group = new Group();
            $rew = $group->dropGroup($groupId);
            if($res && $rew){
                $this->logSave('dropGroup',$groupId);
                $this->renderAjax();
            }else{
                $this->renderErr('操作失败');
            }
        }else{
            $this->renderErr('您没有权限');
        }
    }

    //退出群组
    public function actionQuitGroup(){
        $groupId = $_POST['groupId'];
        $user = new User();
        $user->quitGroup($this->openId,$groupId);
        $group = new Group();
        $group->quitGroup($groupId,$this->openId);
        $this->renderAjax();
    }

    //ajax获取群组成员列表
    public function actionGetMemberList(){
        $groupId = $_POST['groupId'];
        $group = new Group();
        if($group->checkIsCreate($groupId,$this->openId)){
            $list = $group->getMember($groupId);
            $this->renderAjax($list);
        }else{
            $this->renderErr('您没有权限');
        }
    }

    //ajax修改名字
    public function actionUpdateName(){
        $groupId = $_POST['groupId'];
        $newName = $_POST['newName'];
        $group = new Group();
        if($group->checkInGroup($groupId,$this->openId)){
            $list = $group->updateName($groupId,$this->openId,$newName);
            $this->renderAjax($list);
        }else{
            $this->renderErr('您没有权限');
        }
    }
}