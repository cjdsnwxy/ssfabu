<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/26
 * Time: 17:52
 */
class Model
{
    public $collection;

    public function __construct()
    {
        //mongodb = new MongoClient("mongodb://".MONGO_USERNAME.":".MONGO_PWD."@".MONGO_HOST.":".MONGO_PORT);
        $mongodb = new MongoClient();
        $mongo = $mongodb->selectDB(MONGO_DBNAME);
        $Class = lcfirst(get_class($this));
        $this->collection = $mongo->selectCollection($Class);
    }
}