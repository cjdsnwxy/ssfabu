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
<div id="indexPage"  class="weui_msg">
  <div class="weui_icon_area">
    <img src="./Views/Public/img/icon.png">
  </div>
  <div class="weui_text_area">
    <h1 class="weui_msg_title">神速发布系统</h1>
    <p class="weui_msg_desc">welcome to ssfabu</p>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <button id="joinGroupBtn" onclick="showJoinGroupPage()" class="weui_btn weui_btn_primary">加入群组</button>
      <button id="myGroupBtn" onclick="showMyGroupPage()" class="weui_btn weui_btn_primary">我加入的</button>
      <button id="myCreateBtn" onclick="showMyCreatePage()" class="weui_btn weui_btn_primary">我创建的</button>
      <button id="createGroupBtn" onclick="showCreateGroupPage()" class="weui_btn weui_btn_primary">创建群组</button>
    </p>
  </div>
  <div class="weui_extra_area">
    <a href="">使用帮助</a>
  </div>
</div>
<div id="joinGroupPage" style="display: none;" class="weui_msg">
  <div class="weui_icon_area">
    <img src="./Views/Public/img/icon.png">
  </div>
  <div class="weui_text_area">
    <h1 class="weui_msg_title">神速发布系统</h1>
    <p class="weui_msg_desc">加入群组</p>
  </div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_hd"><label class="weui_label">群组ID</label></div>
      <div class="weui_cell_bd weui_cell_primary">
        <input id="joinGroupId" class="weui_input" type="tel" placeholder="请输入群组ID">
      </div>
    </div>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <button onclick="showGroupInfoPageByJoinBtn()" class="weui_btn weui_btn_primary">确定</button>
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
  <div class="weui_extra_area">
    <a href="">使用帮助</a>
  </div>
</div>
<div id="groupInfoPage" style="display: none;" class="weui_msg">
  <div class="weui_text_area">
    <h1 class="weui_msg_title">群组详情</h1>
  </div>
  <div class="weui_opr_area">
    <div class="weui_cells">
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>群组ID</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p id="groupId">110110110</p>
        </div>
      </div>
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>群组名称</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p id="groupName">我也不知道到底要干什么的群组</p>
        </div>
      </div>
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>创建时间</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p id="createTime">2012-12-25</p>
        </div>
      </div>
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>当前人数</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p id="groupNum">123</p>
        </div>
      </div>
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>群组描述</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p align="left" id="groupIntro">Panelweui_panel由head（可选）、body、foot（可选）三部分组成，主要承载了图文组合列表weui_media_appmsg、文字组合列表weui_media_text以及小图文组合列表weui_media_text。</p>
        </div>
      </div>
    </div>
    <p class="weui_btn_area">
      <button id="joinBtn" onclick="joinGroup()" class="weui_btn weui_btn_primary">加入</button>
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
</div>
<div id="myGroupPage" style="display: none;" class="weui_msg">
  <div class="weui_text_area">
    <h1 class="weui_msg_title">神速发布系统</h1>
    <p class="weui_msg_desc">我加入的</p>
  </div>
  <div class="weui_opr_area">
    <div class="weui_cells weui_cells_access">
      <a class="weui_cell" onclick="showGroupInfoPage(this)">
        <div class="weui_cell_bd weui_cell_primary">
          <p align="left">传媒中心通知组</p>
        </div>
      </a>
      <a class="weui_cell" onclick="showGroupInfoPage(this)">
        <div class="weui_cell_bd weui_cell_primary">
          <p align="left">嵌入式软件12-01通知组</p>
        </div>
      </a>
    </div>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
</div>
<div id="myCreatePage" style="display: none;" class="weui_msg">
  <div class="weui_text_area">
    <h1 class="weui_msg_title">神速发布系统</h1>
    <p class="weui_msg_desc">我创建的</p>
  </div>
  <div class="weui_opr_area">
    <div class="weui_cells weui_cells_access">
      <a class="weui_cell" onclick="showGroupInfoPage(this)">
        <div class="weui_cell_bd weui_cell_primary">
          <p>cell standard</p>
        </div>
        <div class="weui_cell_ft">说明文字</div>
      </a>
      <a class="weui_cell" onclick="showGroupInfoPage(this)">
        <div class="weui_cell_bd weui_cell_primary">
          <p>cell standard</p>
        </div>
        <div class="weui_cell_ft">说明文字</div>
      </a>
    </div>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
</div>
<div id="createGroupPage" style="display: none;" class="weui_msg">
  <div class="weui_icon_area">
    <img src="./Views/Public/img/icon.png">
  </div>
  <div class="weui_text_area">
    <h1 class="weui_msg_title">神速发布系统</h1>
  </div>
  <div class="weui_cells_title">群组名称</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <input class="weui_input" type="tel" placeholder="请输入群组名称">
      </div>
    </div>
  </div>
  <div class="weui_cells_title">群组描述</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <textarea class="weui_textarea" placeholder="请输入群组描述" rows="3" ></textarea>
      </div>
    </div>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <button onclick="createGroup()" class="weui_btn weui_btn_primary">创建</button>
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
</div>
<div id="successPage" style="display: none;" class="weui_msg">
  <div class="weui_icon_area"><i class="weui_icon_safe weui_icon_safe_success"></i></div>
  <div class="weui_text_area">
    <h2 class="weui_msg_title">操作成功</h2>
    <p id="successMeg" class="weui_msg_desc"></p>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <a href="" class="weui_btn weui_btn_primary">查看详情</a>
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
</div>
  <script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
  <script src="./Views/Public/js/jquery-weui.js"></script>
  <script src="./Views/Public/js/index.js"></script>
</body>
</html>