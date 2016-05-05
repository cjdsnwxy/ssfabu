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
            die;
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

            //保存消息
            $msg = $this->M('Message');
            $msgId = $msg->createMsg($groupId,$title,$startTime,$address,$intro);
            if($msgId){
                //根据groupId获得群组信息
                $group = $this->M('Group');
                $list = $group->getMemberListWithGroupName($groupId);
                $memberList = $list['member'];
                $groupName = $list['groupName'];

                //引入weChatClass
                include $_SERVER['DOCUMENT_ROOT'] . '/Ext/weChatClass.php';
                $weChatClass = new weChatClass(APPID,APPSECRET);

                //获取access_token
                $redis = $this->redis();
                if($redis->redisGet('access_token')){
                    $access_token = $redis->redisGet('access_token');
                }else{
                    $access_token = $weChatClass->getToken();
                    $redis->redisSet('access_token',$access_token,7000);
                }
                
                //对每个人发送模板消息
                foreach ($memberList as $openId => $name){
                    //获取短链接
                    $loonLink = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa54b997e82462e5a&redirect_uri=http://115.159.186.166/index.php?a=messageApi&c=showMsgInfo&msgId=".$msgId."&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
                    $shortUrl = $weChatClass->getShortLinK($loonLink,$access_token)->short_url;
                    //组装模板消息
                    $template = array(
                        'touser' => $openId,
                        'template_id' => '9nDUG73NbtCSo3Vtx0og8eEJaCXU0PcmGSjZiGhwY-k',
                        'url' => $shortUrl,
                        'data' => array(
                            'first' => array('value' => urlencode($name).',您好,您有一条通知!','color' => '#173177'),
                            'From' => array('value' => urlencode($groupName),'color' => '#173177'),
                            'Title' => array('value' => urlencode($title),'color' => '#173177'),
                            'Time' => array('value' => urlencode($startTime),'color' => '#173177'),
                            'Address' => array('value' => urlencode($address),'color' => '#173177'),
                            'remark' => array('value' => '请务必点击查看详情！','color' => '#173177')
                        ),
                    );
                    $res = $weChatClass->sendTemMsg($template,$access_token);
                    $this->logSave('sendTemplate',$res);
                }
                $this->renderAjax();
            }else{
                $this->renderErr('发送失败');
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

    public function actionIndex(){
        $group = $this->M('Group');
        $list = $group->getMemberListWithGroupName('00000002');
        $memberList = $list['member'];
        foreach ($memberList as $openId => $name ){
            echo 'openId:'.$openId."<br>"."name:".$name;
            echo "<br>";
        }
    }
}