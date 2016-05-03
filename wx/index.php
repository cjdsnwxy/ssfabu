<?php
$code = $_GET['code'];
echo "code->".$code;
echo "<br>";
include 'wxClass.php';
$appId = 'wxa54b997e82462e5a';
$appSecret = '2b9c188883ebf39f9203eaee4876dda5';
$class = new wxClass($appId,$appSecret,$code);
$openId = $class->getOpenId;
echo "openId->".$openId;
