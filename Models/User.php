<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-23
 * Time: 下午10:33
 */
include $_SERVER['DOCUMENT_ROOT'].'/Base/mongo.php';
class User
{
    public function getUserInfo($openId){
        $model = new mongoClass();
        $collection = $model->mongo->user;
        return $collection->findOne(array('openId' => $openId));

    }
}