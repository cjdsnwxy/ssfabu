<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/4
 * Time: 22:21
 */

include 'Ext/weChatClass.php';
$class = new templateMsgClass('wxa54b997e82462e5a','2b9c188883ebf39f9203eaee4876dda5');

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
if($redis->get('access_token')){
    $access_token = $redis->get('access_token');
}else{
    $access_token = $class->getToken();
    $redis->set('access_token',$access_token);
    $redis->expire('access_token',3000);
}
//$template = array(
//    'touser' => 'oSH9atxDieo_DmXkuFhpsX9eoJRY',
//    'template_id' => '9nDUG73NbtCSo3Vtx0og8eEJaCXU0PcmGSjZiGhwY-k',
//    'url' => 'http://www.baidu.com',
//    'data' => array(
//        'first' => array('value' => ',您好,您有一条通知','color' => '#173177'),
//        'Title' => array('value' => '毕业论文最后期限','color' => '#173177'),
//        'Time' => array('value' => '下周二','color' => '#173177'),
//        'Address' => array('value' => '教务处','color' => '#173177'),
//        'remark' => array('value' => '请务必点击查看详情！','color' => '#173177')
//    ),
//);
//var_dump($class->sendTemMsg(urldecode(json_encode($template)),$access_token));
$loonLink = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa54b997e82462e5a&redirect_uri=http://115.159.186.166/index.php&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
var_dump($class->getShortLinK($loonLink,$access_token));