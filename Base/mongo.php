<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-21
 * Time: 下午9:15
 */
class mongoClass
{

    private $db;

    function __construct()
    {
        $conf = include 'conf.php';
        $mongo = new MongoClient("mongodb://".$conf['mongo']['username'].":".$conf['mongo']['passwd']."@".$conf['mongo']['host'].":".$conf['mongo']['port']);
        $this->db = $mongo->$conf['mongo']['dbname'];
    }

    public function showAll($collectionName){
        $collection = $this->db->$collectionName;
        return $collection->find();
    }
}