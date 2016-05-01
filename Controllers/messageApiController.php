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

    //获得收到信息列表
    public function actionReceiveMsgList(){

    }

    //获得发送的信息列表
    public function actionSendMsgList(){

    }
}