<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-4-15
 * Time: 下午2:44
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Model.php';
class Group extends Model
{
    public function createGroup($openId,$groupName,$intro){
        //findAndModify查找并更新函数，具有原子性
        $locations=$this->collection->findAndModify(array('_id'=>'groupId'),array('$inc'=>array('id'=>1)),array(),array('new'=>true));
        //格式化groupId
        $groupId = sprintf("%08d", $locations['id']);
        $groupInfo = array(
            "_id" => $groupId,
            "createUser" => $openId,
            "groupName" => $groupName,
            "createTIme" =>  date('Y-m-d H:i:s',time()),
            "groupNum" => 1,
            "groupIntro" => $intro
        );
        $options = array('safe'=>true);
        try {
            $this->collection->insert($groupInfo,$options);
            return true;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }
}