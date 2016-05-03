<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-4-15
 * Time: 下午3:36
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Model.php';
class Message extends Model
{
    public function createMsg($groupId,$title,$startTime,$address,$intro=''){
        //findAndModify查找并更新函数，具有原子性
        $locations=$this->collection->findAndModify(array('_id'=>'msgId'),array('$inc'=>array('id'=>1)),array(),array('new'=>true));
        //格式化msgId
        $msgId = sprintf("%08d", $locations['id']);
        $msgInfo = array(
            "_id" => $msgId,
            "groupId" => $groupId,
            "title" => $title,
            "startTime" => $startTime,
            "address" => $address,
            "intro" => $intro,
            "createTime" =>  date('Y-m-d H:i:s',time())
        );
        $options = array('w'=>true);
        try {
            $this->collection->insert($msgInfo,$options);
            return $msgId;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }

    public function getMsgList($groupId){
        $msgList = $this->collection->find(array('groupId' => $groupId),array("title"));
        $list = array();
        foreach ($msgList as $value) {
            $arr = array(
                'msgId' => $value['_id'],
                'title' => $value['title']
            );
            $list = array_merge_recursive($list,array($arr));
        }
        return $list;
    }

    public function getMsgInfo($msgId){
        return $this->collection->findOne(array('_id' => $msgId));
    }
}