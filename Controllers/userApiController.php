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
        var_dump($groupList);
    }
}