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
        if($group->checkInGroup($groupId,$this->openId)){
            $this->renderErr("您已经在群组中.");
            die;
        }
        $group->joinGroup($groupId,$this->openId);
        $user = $this->M('User');
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

    //解散群组
    public function dropGroup($groupId){
        //验证是否是创建人

        $group = $this->M('Group');
        $group->dropGroup($groupId);
        $user = $this->M('User');
        $user->dropGroup($groupId);
    }
    //退出群组
    public function quitGroup($groupId){
        $user = $this->M('User');
        $res = $user->quitGroup($groupId);
        if($res == false){
            $this->renderErr('您已不再此群中');
        }else{
            $group = $this->M('Group');
            $group->quitGroup($groupId);
        }
        $this->renderAjax();
    }
}
