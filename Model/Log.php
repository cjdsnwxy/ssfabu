<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/26
 * Time: 17:34
 */
class Log extends Model
{
    public function saveLog($type,$logData,$openId){
        //findAndModify查找并更新函数，具有原子性
        $locations=$this->collection->findAndModify(array('_id'=>'logId'),array('$inc'=>array('id'=>1)),array(),array('new'=>true));
        //格式化groupId
        $msgId = $locations['id'];
        $msgInfo = array(
            "_id" => $msgId,
            "type" => $type,
            "logData" => $logData,
            "createTime" =>  date('Y-m-d H:i:s',time()),
            "createUser" => $openId

        );
        $options = array('w'=>true);
        try {
            $this->collection->insert($msgInfo,$options);
            return true;
        }
        catch (MongoCursorException $e) {
            return false;
        }
    }
}