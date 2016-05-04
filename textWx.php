<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/4
 * Time: 22:21
 */

include 'Ext/getAccessTokenClass.php';
$class = new getAccessTokenClass('wxa54b997e82462e5a','2b9c188883ebf39f9203eaee4876dda5');
$a = $class->getToken()->access_token;
var_dump($a);