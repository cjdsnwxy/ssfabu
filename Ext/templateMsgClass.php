<?php
/**
 * 微信模板消息类
 * @author 王晓阳 <[cjdsnwxy@gmail.com]>
 * 2016-05-04
 *
 */
class templateMsgClass{
    private $appId;
    private $appSecret;
    private $data;
    private $access_token;
    public function __construct($data,$access_token){
        $this->data = $data;
        $this->access_token = $access_token;
    }

    private function getToken(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appId."&secret=".$this->appSecret;
        return json_decode($this->httpGet($url));
    }
    private function httpGet($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}
