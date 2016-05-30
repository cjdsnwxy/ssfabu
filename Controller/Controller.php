<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/26
 * Time: 16:30
 */
class Controller
{
    public $openId;

    public function __construct()
    {
        //获取openId
        session_start();
        if(isset($_SESSION['openId'])){
            $this->openId = $_SESSION['openId'];
        }else{
//            if(empty($_GET['code'])){
//                die;
//            }
//            $code = $_GET['code'];
//            include_once $_SERVER['DOCUMENT_ROOT'].'/Ext/getOpenIdClass.php';
//            $getOpenIdClass = new getOpenIdClass(APPID,APPSECRET,$code);
//            $this->openId = $getOpenIdClass->getOpenId();
            $this->openId = '111111';
            $user = new User();
            $user->createUser($this->openId);
            $_SESSION['openId'] = $this->openId;
        }
    }

    //redisClass
    public static function redis(){
        $redis = new Redis();
        $redis->connect(REDIS_HOST,REDIS_PORT);
        return $redis;
    }

    //logSave函数
    public function logSave($type,$logData){
        $log = new Log();
        return $log->saveLog($type,$logData,$this->openId);
    }

    //访问View层函数
    public function display($path,$param = []){
        if(!empty($param)){
            extract($param);
        }
        ob_end_clean (); //关闭顶层的输出缓冲区内容
        ob_start ();     // 开始一个新的缓冲区
        require $_SERVER['DOCUMENT_ROOT'] . '/View/Page/header.php';
        require $_SERVER['DOCUMENT_ROOT'].'/View/'.$path.'.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/View/Page/footer.php';
        $content = ob_get_contents ();             // 获得缓冲区的内容
        ob_end_clean ();           // 关闭缓冲区
        ob_start();            //开始新的缓冲区，给后面的程序用
        echo $content;       // 返回文本，此处也可以字节echo出来，并结束代码。
    }

    //ajax返回JSON数据
    public function renderAjax($obj = null){
        $json = [
            'ok' => 0
        ];
        if (isset($obj)) {
            $json['obj'] = $obj;
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        echo $json;
    }

    //ajax返回error数据
    public function renderErr($error = ""){
        $json = [
            'error' => 0,
            'msg' =>$error
        ];
        echo json_encode($json);
    }

}