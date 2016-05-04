<?php
/**
 * 获取基础Access_token类
 * @author 王晓阳 <[cjdsnwxy@gmail.com]>
 * 2015-12-03
 *
 */
class getAccessTokenClass{
    private $appId;
    private $appSecret;

    public function __construct($appId,$appSecret){
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    public function getToken(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appId."&secret=".$this->appSecret;
        return json_decode($this->httpGet($url))->access_token;
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
