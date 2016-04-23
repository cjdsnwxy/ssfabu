<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-20
 * Time: 下午9:37
 */
class Model
{
    private $mongo;

    public $collection;

    function __construct(){
        include_once $_SERVER['DOCUMENT_ROOT'].'/Base/mongo.php';
        $mongoClass = new mongoClass();
        $this->mongo = $mongoClass->mongo;
        $Class = lcfirst(get_class($this));
        $this->collection = $mongoClass->mongo->selectCollection($Class);
    }
}