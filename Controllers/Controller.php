<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:49
 */
class Controller
{
    public $openId;

    function __construct(){
        include $_SERVER['DOCUMENT_ROOT'].'/Base/conf.php';
        session_start();
        if(isset($_SESSION['openId'])){
            $this->openId = $_SESSION['openId'];
        }else{
            if(empty($_GET['code'])){
                $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?
                appid=wxa54b997e82462e5a&redirect_uri=http://115.159.186.166/index.php
                &response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
                header("Location:".$url);
                exit;
            }else{
                include $_SERVER['DOCUMENT_ROOT'].'/Ext/wxClass.php';
                $wxClass = new wxClass(APPID,APPSECRET,$code);
                $this->openId = $wxClass->getOpenId();
                $user = $this->M('User');
                $user->createUser($this->openId);
                $_SESSION['openId'] = $this->openId;
            }
        }
    }

    //调用redis缓存函数
    protected function redis(){
        include $_SERVER['DOCUMENT_ROOT'].'/Base/redis.php';
        return new redisClass();
    }

    //访问Controller层函数
    public function C($controller){
        include $_SERVER['DOCUMENT_ROOT'].'/Controller/'.$controller.'.php';
        $controller = 'action'.ucfirst($controller);
        return new $controller;
    }

    //访问Model层函数
    public function M($model){
        include_once $_SERVER['DOCUMENT_ROOT'].'/Models/'.$model.'.php';
        return new $model;
    }

    //访问View层函数
    public function display($path,$param = []){
        if(!empty($param)){
            extract($param);
        }
        ob_end_clean (); //关闭顶层的输出缓冲区内容
        ob_start ();     // 开始一个新的缓冲区
        require $_SERVER['DOCUMENT_ROOT'].'/Views/Index/header.php';
        require $_SERVER['DOCUMENT_ROOT'].'/Views/'.$path.'.php';
        require $_SERVER['DOCUMENT_ROOT'].'/Views/Index/footer.php';
        $content = ob_get_contents ();             // 获得缓冲区的内容
        ob_end_clean ();           // 关闭缓冲区
        ob_start();            //开始新的缓冲区，给后面的程序用
        echo $content;       // 返回文本，此处也可以字节echo出来，并结束代码。
    }

    public function logSave($type,$logData){
        $log = $this->M('Log');
        return $log->saveLog($type,$logData,$this->openId);
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