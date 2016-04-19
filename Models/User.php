<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-23
 * Time: 下午10:33
 */
include $_SERVER['DOCUMENT_ROOT'].'/Models/Model.php';
class User extends Model
{
    public function findUser($openId){
        return $this->collection->findOne(array('openId' => $openId));
    }

    public function getUserInfo($openId){
        return $this->collection->findOne(array('openId' => $openId));
    }

    public function getUserName($openId){
        return $this->collection->findOne(array('openId' => $openId),array('username'));
    }

    public function getJoinGroup($openId){
        return $this->collection->findOne(array('openId' => $openId),array('joinGroup'));
    }

    public function getCreateGroup($openId){
        return $this->collection->findOne(array('openId' => $openId),array('CreateGroup'));
    }

    public function JoinGroup($openId,$groupId){

    }

    public function CreateGroup($openId,$groupId){

    }
}