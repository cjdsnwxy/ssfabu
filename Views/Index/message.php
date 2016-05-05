<div id="sendMsgPage" class="weui_msg">
    <div class="weui_text_area">
        <h1 class="weui_msg_title">神速发布系统</h1>
        <p class="weui_msg_desc">查看消息</p>
    </div>
    <div class="weui_cells_title"><b>群组ID</b></div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input id="groupIdInSendMsgPage" class="weui_input" type="text" value="<?php echo $groupId;?> disabled="true">
            </div>
        </div>
    </div>
    <div class="weui_cells_title">消息名称</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input id="msgTitleInSendMsgPage" class="weui_input" type="text" value="<?php echo $title;?> disabled="true">
            </div>
        </div>
    </div>
    <div class="weui_cells_title">开始时间</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input id="startTimeInSendMsgPage" class="weui_input" type="text" value="<?php echo $startTime;?> disabled="true">
            </div>
        </div>
    </div>
    <div class="weui_cells_title">地点</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <input id="addressInSendMsgPage" class="weui_input" type="text" value="<?php echo $address;?>" disabled="true">
            </div>
        </div>
    </div>
    <div class="weui_cells_title">详情描述</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea id="introInSendMsgPage" class="weui_textarea" rows="3" disabled="true">
                    <?php echo $intro;?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="weui_opr_area">
        <p class="weui_btn_area">
            <a href="" class="weui_btn weui_btn_default">返回首页</a>
        </p>
    </div>
</div>