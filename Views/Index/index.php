<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-23
 * Time: 下午10:07
 */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
  <title></title>
  <link rel="stylesheet" href="http://res.wx.qq.com/open/libs/weui/0.4.1/weui.css">
  <link rel="stylesheet" href="./Views/Public/css/jquery-weui.css">
</head>
<body>
<div id="indexPage" class="weui_msg">
  <div class="weui_icon_area">
    <img style="color:#04BE02" src="./Views/Public/img/icon.png">
  </div>
  <div class="weui_text_area">
    <h1 class="weui_msg_title">神速发布系统</h1>
    <p class="weui_msg_desc">告诉我你想做什么</p>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <a id="joinGroupBtn" class="weui_btn weui_btn_primary">加入群组</a>
      <a id="myGroupBtn" class="weui_btn weui_btn_primary">我加入的</a>
      <a id="myCreateBtn" class="weui_btn weui_btn_primary">我创建的</a>
      <a id="createGrouoBtn" class="weui_btn weui_btn_primary">创建群组</a>
    </p>
  </div>
  <div class="weui_extra_area">
    <a href="">使用帮助</a>
  </div>
</div>
<div id="joinGroupPage" style="display: none;">
  加入群组
</div>
<div id="myGroupPage" style="display: none;">
  我加入的
</div>
<div id="myCreatePage"style="display: none;" >
  我创建的
</div>
<div id="createGroupPage" style="display: none;">
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_hd"><label class="weui_label">时间</label></div>
      <div class="weui_cell_bd weui_cell_primary">
        <input id='datetime-picker' type="text" class="weui_input" placeholder="请输入时间">
      </div>
    </div>
  </div>
  <script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
  <script src="./Views/Public/js/jquery-weui.js"></script>
  <script src="./Views/Public/js/page.js"></script>
</body>
</html>
