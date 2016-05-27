<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/5/26
 * Time: 16:02
 */
//根目录常量
define("SERVER_ROOT", dirname(__FILE__));

//域名常量
define('SITE_ROOT' , 'http://www.ssfabu.cn');

//引入配置文件
require (SERVER_ROOT . '/Conf/' . 'conf.php');

//引入路由文件
require (SERVER_ROOT . '/Base/' . 'router.php');