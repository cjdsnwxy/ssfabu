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
          <p id="groupIdInGroupInfoPage"></p>
        </div>
      </div>
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>群组名称</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p id="groupNameInGroupInfoPage"></p>
        </div>
      </div>
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>创建时间</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p id="createTimeInGroupInfoPage"></p>
        </div>
      </div>
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>当前人数</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p id="groupNumInGroupInfoPage"></p>
        </div>
      </div>
      <div class="weui_cell">
        <div class="weui_cell_bd">
          <p>群组描述</p>
        </div>
        <div class="weui_cell_ft weui_cell_primary" >
          <p id="groupIntroInGroupInfoPage"></p>
        </div>
      </div>
    </div>
    <p class="weui_btn_area">
      <button id="quitGroupBtn" onclick="quitGroup()" class="weui_btn weui_btn_warn" >退出</button>
      <button id="sendMsgBtn" onclick="showSendMsgPage()" class="weui_btn weui_btn_primary" >发送消息</button>
      <button id="showMemberBtn" onclick="showMemberPage()" class="weui_btn weui_btn_primary" >查看成员</button>
      <button id="showHisMsgBtn" onclick="showHistoryMsgPage()" class="weui_btn weui_btn_primary" >查看历史消息</button>
      <button id="updateGroupBtn" onclick="showUpdateGroupPage()" class="weui_btn weui_btn_primary" >修改群组信息</button>
      <button id="DropGroupBtn" onclick="dropGroup()" class="weui_btn weui_btn_warn" >解散群组</button>
      <button id="updateNameBtn" onclick="updateName()" class="weui_btn weui_btn_primary">修改姓名</button>
      <button id="blackBtn" class="weui_btn weui_btn_primary" style="display: none;">返回列表</button>
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
    <div id="myGroupList" class="weui_cells weui_cells_access">

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
    <div id="myCreateList" class="weui_cells weui_cells_access">

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
        <input id="groupNameInCreatePage" class="weui_input" type="text" placeholder="请输入群组名称">
      </div>
    </div>
  </div>
  <div class="weui_cells_title">群组描述</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <textarea id="groupIntroInCreatePage" class="weui_textarea" placeholder="请输入群组描述" rows="3" ></textarea>
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
<div id="updateGroupPage" style="display: none;" class="weui_msg">
  <div class="weui_icon_area">
    <img src="./Views/Public/img/icon.png">
  </div>
  <div class="weui_text_area">
    <h1 class="weui_msg_title">神速发布系统</h1>
    <p class="weui_msg_desc" id="groupIdInUpdateGroupPage"></p>
  </div>
  <div class="weui_cells_title">群组名称</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <input id="groupNameInUpdateCreatePage" class="weui_input" type="text">
      </div>
    </div>
  </div>
  <div class="weui_cells_title">群组描述</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <textarea id="groupIntroInUpdateCreatePage" class="weui_textarea" rows="3" ></textarea>
      </div>
    </div>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <button onclick="updateGroup()" class="weui_btn weui_btn_primary">更新</button>
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
</div>
<div id="sendMsgPage" style="display: none;" class="weui_msg">
  <div class="weui_text_area">
    <h1 class="weui_msg_title">发送消息</h1>
  </div>
  <div class="weui_cells_title"><b>群组ID</b></div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <input id="groupIdInSendMsgPage" class="weui_input" type="text" disabled="true">
      </div>
    </div>
  </div>
  <div class="weui_cells_title">消息名称</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <input id="msgTitleInSendMsgPage" class="weui_input" type="text">
      </div>
    </div>
  </div>
  <div class="weui_cells_title">开始时间</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <input id="startTimeInSendMsgPage" class="weui_input" type="text">
      </div>
    </div>
  </div>
  <div class="weui_cells_title">地点</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <input id="addressInSendMsgPage" class="weui_input" type="text">
      </div>
    </div>
  </div>
  <div class="weui_cells_title">详情描述</div>
  <div class="weui_cells weui_cells_form">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <textarea id="introInSendMsgPage" class="weui_textarea" rows="3" ></textarea>
      </div>
    </div>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <button onclick="sendMsg()" class="weui_btn weui_btn_primary">发送</button>
      <button onclick="showMyCreatePage()" class="weui_btn weui_btn_default">返回列表</button>
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
</div>
<div id="memberPage" style="display: none;" class="weui_msg">
  <div class="weui_text_area">
    <h1 id="groupNameInMemberPage" class="weui_msg_title"></h1>
  </div>
  <div class="weui_opr_area">
    <div id="memberList" class="weui_cells weui_cells_access">

    </div>
  </div>
  <div class="weui_opr_area">
    <p class="weui_btn_area">
      <button onclick="showIndexPage()" class="weui_btn weui_btn_default">返回首页</button>
    </p>
  </div>
</div>