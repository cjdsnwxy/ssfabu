<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-21
 * Time: 下午9:15
 */
class mongoClass
{

    public $mongo;

    function __construct()
    {
        $conf = include 'conf.php';
        $mongodb = new MongoClient("mongodb://".$conf['mongo']['username'].":".$conf['mongo']['pwd']."@".$conf['mongo']['host'].":".$conf['mongo']['port']);
        //$mongodb = new MongoClient();
        $this->mongo = $mongodb->selectDB($conf['mongo']['dbName']);
    }
}