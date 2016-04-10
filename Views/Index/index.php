<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-23
 * Time: 下午10:07
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>你好，你的username=<?php echo $user['username'] ?>！</h1>
    <h1>你好，你的openId=<?php echo $user['openId'] ?>！</h1>
    <h1>你好，你的phone=<?php echo $user['phone'] ?>！</h1>
    <h1>你好，你的headimage=<?php echo $user['headimage'] ?>！</h1>
    <h1>你好，你加入的群组有“<?php echo $user['joinGroup'] ?>！</h1>
    <h1>你好，你创建的群组有“<?php echo $user['createGroup'] ?>！</h1>
  </body>
</html>