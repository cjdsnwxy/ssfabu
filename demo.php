<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);


include "./Base/redis.php";
$redis = new redisClass();
$redis->set('aa','aaa');
echo $redis->get('aa');