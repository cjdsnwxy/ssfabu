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

    //扫描二维码加入群组
    public function actionJoinGroupByQrc($groupId){
        $group = $this->M('Group');
        if($group->checkInGroup($groupId,$this->openId)){
            $this->display('Index/msgPage',array(
                'type'=>'warn',
                'msg' => '您已经在群组内'
            ));
        }
        $group->joinGroup($groupId,$this->openId);
        $user = $this->M('User');
        $user->joinGroup($this->openId,$groupId);
        $this->display('Index/msgPage',array(
            'type' => 'success',
            'msg' => '加入群组成功'
        ));
    }

    //创建群组
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

    //加入群组
    public function actionJoinGroup(){
        $groupId = $_POST['groupId'];
        $group = $this->M('Group');
        $user = $this->M('User');
        if($group->checkIsCreate($groupId,$this->openId)){
            $this->renderErr("您是群主");
            die;
        }
        if($group->checkInGroup($groupId,$this->openId)){
            $this->renderErr("您已经在群组中.");
            die;
        }
        $group->joinGroup($groupId,$this->openId);
        $user->joinGroup($this->openId,$groupId);
        $this->renderAjax();
    }

    //查找群组
    public function actionFindGroup(){
        $groupId = $_POST['groupId'];
        // $groupId =  "00000001";
        $group = $this->M('Group');
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
        $group = $this->M('Group');
        if($group->checkIsCreate($groupId,$this->openId)){
            $group->updateGroup($groupId,$groupName,$intro);
            $this->renderAjax();
        }else{
            $this->renderErr('您没有权限');
        }
    }

    //解散群组
    public function actionDropGroup(){
        $groupId = $_POST['groupId'];
        //验证是否是创建人
        $user = $this->M('User');
        if($user->checkIsCreate($this->openId,$groupId)){
            $res = $user->dropGroup($this->openId,$groupId);
            $group = $this->M('Group');
            $rew = $group->dropGroup($groupId);
            if($res && $rew){
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
        $user = $this->M('User');
        $res = $user->quitGroup($this->openId,$groupId);
        if($res == false){
            $this->renderErr('您不再此群中');
        }else{
            $group = $this->M('Group');
            $group->quitGroup($groupId,$this->openId);
        }
        $this->renderAjax();
    }

    //修改姓名
    public function actionUpdateName(){
        if(empty($_POST['newName'])){
            
        }
        $newName = $_POST['newName'];
        $user = $this->M('User');
        $res = $user->updateName($this->openId,$newName);
        if($res){
            $this->renderAjax();
        }else{
            $this->renderErr('修改失败，请重试');
        }
    }
}
