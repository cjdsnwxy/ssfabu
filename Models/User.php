<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-23
 * Time: 下午10:33
 */
include_once $_SERVER['DOCUMENT_ROOT'].'/Models/Model.php';
class User extends Model
{

    public function createUser($openId){
        try {
            $this->collection->insert(array("_id" => $openId),array('w'=>true));
            return true;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }

    public function getUserInfo($openId){
        return $this->collection->findOne(array('_id' => $openId));
    }

    public function getUserName($openId){
        return $this->collection->findOne(array('_id' => $openId),array('username'));
    }

    public function getJoinGroup($openId){
        return $this->collection->findOne(array('_id' => $openId),array('joinGroup'));
    }

    public function getCreateGroup($openId){
        $this->collection->findOne(array('_id' => $openId),array('createGroup'));
    }

    public function joinGroup($openId,$groupId){
        try {
            $this->collection->update(
                array('_id'=>$openId),
                array('$push'=>array('joinGroup'=>$groupId)),
                array('w'=>true)
            );
            return true;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }

    public function createGroup($openId,$groupId){
        try {
            $this->collection->update(
                array('_id'=>$openId),
                array('$push'=>array('createGroup'=>$groupId)),
                array('w'=>true)
            );
            return true;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }
}