<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-20
 * Time: 下午9:37
 */
class model
{
    public $model;

    function __construct(){

        $this->model = new mongoClass();
    }
}