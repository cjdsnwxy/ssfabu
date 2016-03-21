<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-20
 * Time: 下午4:06
 */
class Demo
{
    function __construct(){
        include $_SERVER['DOCUMENT_ROOT'].'/Base/mongo.php';
    }

    public function demo(){
        return "this is Demo Model！";
    }
}