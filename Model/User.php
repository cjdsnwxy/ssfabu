<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/26
 * Time: 16:29
 */
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

    public function getJoinGroup($openId){
        return $this->collection->findOne(array('_id' => $openId),array('joinGroup'));
    }

    public function getCreateGroup($openId){
        return $this->collection->findOne(array('_id' => $openId),array('createGroup'));
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

    public function checkIsCreate($openId,$groupId){
        try {
            $res = $this->collection->findOne(array('_id' =>$openId,'createGroup'=>$groupId));
            if($res != null){
                return true;
            }else{
                return false;
            }
        }
        catch (MongoCursorException $e){
            return false;
        }

    }

    public function dropGroup($openId,$groupId){
        try {
            $this->collection->update(
                array('_id'=>$openId),
                array('$pull'=>array('createGroup'=>$groupId)),
                array('w'=>true)
            );
            return true;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }

    public function quitGroup($openId,$groupId){
        try {
            $this->collection->update(
                array('_id'=>$openId),
                array('$pull'=>array('joinGroup'=>$groupId)),
                array('w'=>true)
            );
            return true;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }

    public function updateName($openId,$newName){
        try {
            $this->collection->update(
                array('_id'=>$openId),
                array('name'=>$newName)
            );
            return true;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }
}