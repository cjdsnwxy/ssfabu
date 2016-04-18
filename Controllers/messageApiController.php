<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-4-15
 * Time: 下午3:35
 */
include $_SERVER['DOCUMENT_ROOT'].'/Controllers/Controller.php';
class messageApiController extends Controller
{
    //发送信息
    public function sendMsg(){
        $openId = $this->openId;
        $groupId = $_POST['groupId'];
    }

    //查看收到的信息列表
    public function receiveMsg(){

    }


}