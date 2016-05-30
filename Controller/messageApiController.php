<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/26
 * Time: 23:52
 */
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
            $msg = new Message();
            $msgId = $msg->createMsg($groupId,$title,$startTime,$address,$intro);
            if($msgId){
                //根据groupId获得群组信息
                $group = new Group();
                $list = $group->getMemberListWithGroupName($groupId);
                $memberList = $list['member'];
                $groupName = $list['groupName'];
                //引入weChatClass
                include $_SERVER['DOCUMENT_ROOT'] . '/Ext/templateMessageClass.php';
                $templateMessageClass = new templateMessageClass(APPID,APPSECRET);
                //获取access_token
                $redis = new Redis();
                $redis->connect(REDIS_HOST,REDIS_PORT);
                if($redis->get('access_token')){
                    $access_token = $redis->get('access_token');
                }else{
                    $access_token = $templateMessageClass->getToken();
                    $redis->set('access_token',$access_token,7000);
                }
                $loonLink = "https://open.weixin.qq.com/connect/oauth2/authorize?
                            appid=".APPID."&redirect_uri=".SITE_ROOT."/index.php
                            &response_type=code&scope=snsapi_base&state=".$msgId.
                            "#wechat_redirect";
                //获取短链接
                $shortUrl = $templateMessageClass->getShortLinK($loonLink,$access_token)->short_url;
                $redis = parent::redis();
                $hash = 'msg'.$msgId;
                //对每个人发送模板消息
                foreach ($memberList as $openId => $name){
                    //初始化模板消息查阅状态
                    $redis->hSet($hash,$openId,'0');
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
                    $res = $templateMessageClass->sendTemMsg($template,$access_token);
                    $this->logSave('sendTemplate',$res);
                }
                $redis->expire($hash,172800);
                $this->renderAjax();
            }else{
                $this->renderErr('发送失败');
            }
        }
    }
    //获得发送的信息列表
    public function actionGetMsgList(){
        $groupId = $_POST['groupId'];
        $group = new Group();
        if($group->checkIsCreate($groupId,$this->openId)){
            $msg = new Message();
            $list = $msg->getMsgList($groupId);
            $this->renderAjax($list);
        }else{
            $this->renderErr('没有权限');
        }
    }

    //获得消息详情
    public function actionGetMsgInfo(){
        $msgId = $_POST['msgId'];
        $message = new Message();
        $msgInfo = $message->getMsgInfo($msgId);
        if(!empty($msgInfo)){
            $this->renderAjax($msgInfo);
        }
    }
    
    //获得消息查阅状态
    public function actionGetMsgState(){
        $msgId = $_POST['msgId'];
        //验证是否是群主
        $message = new Message();
        $messageInfo = $message->getMsgInfo($msgId);
        $group = new Group();
        $res =  $group->checkIsCreate($messageInfo['groupId'],$this->openId);
        if($res){
            $memberList = $group->getMemberListWithGroupName($messageInfo['groupId']);
            //获取查阅状态
            $key = 'msg'.$msgId;
            $redis = parent::redis();
            $states = $redis->hGetAll($key);
            $members = $memberList['member'];
            $openIds =array_keys(array_intersect_key($members,$states));
            $obj  = array();
            foreach ($openIds as $val){
                $obj = array_merge($obj,array(array('name' => $members[$val],'state' => $states[$val])));
            }
            $this->renderAjax($obj);
        }else{
            $this->renderErr();
        }
    }
}