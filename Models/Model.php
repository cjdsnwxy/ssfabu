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
        include $_SERVER['DOCUMENT_ROOT'].'/Base/mongo.php';
        $mongoClass = new mongoClass();
        $Class = lcfirst(get_class($this));
        $this->collection = $mongoClass->mongo->$Class;
    }
}