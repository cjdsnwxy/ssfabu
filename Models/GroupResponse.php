<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-4-18
 * Time: 下午3:53
 */

class GroupResponse
{
    /**
     * 群组ID
     * @var int
     */
    public $id;

    /**
     * 组员姓名
     * @var array
     */
    public $member;

    public function __construct($id,$member){
        $this->id = $id;
        $this->member = $member;
    }
}