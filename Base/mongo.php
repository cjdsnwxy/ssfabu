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
        //$mongodb = new MongoClient("mongodb://".MONGO_USERNAME.":".MONGO_PWD."@".MONGO_HOST.":".MONGO_PORT);
        $mongodb = new MongoClient();
        $this->mongo = $mongodb->selectDB(MONGO_DBNAME);
    }
}