<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-5-5
 * Time: 上午10:58
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/Models/Model.php';
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