<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-4-18
 * Time: 下午4:44
 */

include $_SERVER['DOCUMENT_ROOT'].'/Controllers/Controller.php';
class messageApiController extends Controller
{
    //发送信息
    public function actionSendMsg(){
        if(empty($_POST['groupId']) || empty($_POST['title']) || empty($_POST['startTime']) || empty($_POST['address'])){
            $this->renderErr('信息不得为空');
        }else{
            $groupId = $_POST['groupId'];
            $title = $_POST['title'];
            $startTime = $_POST['startTime'];
            $address = $_POST['address'];
           if(empty($_POST['intro'])){
               $intro = '无';
           }else{
               $intro = $_POST['intro'];
           }
            $msg = $this->M('Message');
            $msgId = $msg->createMsg($groupId,$title,$startTime,$address,$intro);
            if($msgId){
                $this->renderAjax();
            }else{
                $this->renderErr('发送失败请重试');
            }
        }
    }

    //获得发送的信息列表
    public function actionGetMsgList(){
        $groupId = $_POST['groupId'];
        $group = $this->M('Group');
        if($group->checkIsCreate($groupId,$this->openId)){
            $msg = $this->M('Message');
            $list = $msg->getMsgList($groupId);
            $this->renderAjax($list);
        }else{
            $this->renderErr('没有权限');
        }
    }

    //获得消息详情
    public function actionGetMsgInfo(){
        $msgId = $_POST['msgId'];
        $message = $this->M('Message');
        $msgInfo = $message->getMsgInfo($msgId);
        if(!empty($msgInfo)){
            $this->renderAjax($msgInfo);
        }
    }
}