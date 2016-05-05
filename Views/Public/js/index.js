$(document).ready(function(){
  $("#datetime-picker").datetimePicker();
});
function showIndexPage(){
  $(".weui_msg").hide();
  $("#indexPage").show();
}
function showJoinGroupPage(){
  $("#joinGroupId").val("");
  $(".weui_msg").hide();
  $("#joinGroupPage").show();
  $("#joinGroupId").focus();
}
function showMyGroupPage(){
  $.ajax({
    type: "POST",
    url: "/index.php?c=userApi&a=getJoinGroup",
    dataType: "json", //表示返回值类型，不必须
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $(".weui_msg").hide();
        var groupList = "";
        $.each(j.obj,function(n,value) {
          var list = "";
          list += "<a class='weui_cell' onclick=\"showGroupInfoPageByMyGroupPage('"+ value.groupId +"')\"><div class='weui_cell_bd weui_cell_primary'><p align='left'>" + value.groupName +"</p></div></a>"
          groupList+=list;
        });
        $("#myGroupList").children().remove();
        $("#myGroupList").append(groupList);
        $("#blackBtn").removeAttr("onclick");
        $("#blackBtn").show().attr("onclick","showMyGroupPage();");
        $("#myGroupPage").show();
      }else{
        $.hideLoading();
        $.alert(j.msg);
        showIndexPage();
      }
    }
  });
}
function showMyCreatePage(){
  $.ajax({
    type: "POST",
    url: "/index.php?c=userApi&a=getCreateGroup",
    dataType: "json", //表示返回值类型，不必须
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $(".weui_msg").hide();
        var groupList = "";
        $.each(j.obj,function(n,value) {
          var list = "";
          list += "<a class='weui_cell' onclick=\"showGroupInfoPageByMyCreatePage('"+ value.groupId +"')\"><div class='weui_cell_bd weui_cell_primary'><p align='left'>" + value.groupName +"</p></div></a>"
          groupList+=list;
        });
        $("#myCreateList").children().remove();
        $("#myCreateList").append(groupList);
        $("#blackBtn").removeAttr("onclick");
        $("#blackBtn").show().attr("onclick","showMyCreatePage();");
        $("#myCreatePage").show();
      }else{
        $.hideLoading();
        $.alert(j.msg);
        showIndexPage();
      }
    }
  });
}
function showCreateGroupPage(){
  $("#groupNameInCreatePage").val("");
  $("#groupIntroInCreatePage").val("");
  $(".weui_msg").hide();
  $("#createGroupPage").show();
}
function showSendMsgPage(){
  var groupId = $("#groupIdInGroupInfoPage").html();
  $("#groupIdInSendMsgPage").val(groupId);
  $("#msgTitleInSendMsgPage").val("");
  $("#startTimeInSendMsgPage").datetimePicker().val("");
  $("#addressInSendMsgPage").val("");
  $("#introInSendMsgPage").val("");
  $(".weui_msg").hide();
  $("#sendMsgPage").show();
}
function showGroupInfoPageByJoinBtn(){
  $("#quitGroupBtn").hide();
  $("#sendMsgBtn").hide();
  $("#showMemberBtn").hide();
  $("#showHisMsgBtn").hide();
  $("#updateNameBtn").hide();
  $("#joinBtn").show();
  $("#updateGroupBtn").hide();
  $("#DropGroupBtn").hide();
  $("#blackBtn").hide();
  var groupId = $("#joinGroupId").val();
  if(groupId.length == 0 || isNaN(groupId || groupId.length > 8)) {
    $.alert("请出入正确的群组ID", "警告", function() {
      $("#joinGroupId").focus();
    });
  } else {
    showGroupInfoPage(groupId);
  }
}
function showGroupInfoPageByMyGroupPage(groupId) {
  $("#quitGroupBtn").show();
  $("#updateNameBtn").show();
  $("#sendMsgBtn").hide();
  $("#showMemberBtn").hide();
  $("#showHisMsgBtn").hide();
  $("#joinBtn").hide();
  $("#updateGroupBtn").hide();
  $("#DropGroupBtn").hide();
  showGroupInfoPage(groupId);
}
function showGroupInfoPageByMyCreatePage(groupId){
  $("#quitGroupBtn").hide();
  $("#sendMsgBtn").show();
  $("#showMemberBtn").show();
  $("#showHisMsgBtn").show();
  $("#joinBtn").hide();
  $("#updateGroupBtn").show();
  $("#DropGroupBtn").show();
  $("#updateNameBtn").hide();
  showGroupInfoPage(groupId);
}
function showGroupInfoPage(groupId){
  $.showLoading();
  $.ajax({
    type: "POST",
    url: "/index.php?c=groupApi&a=findGroup",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupId : groupId
    },
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $("#groupIdInGroupInfoPage").text(j.obj.groupId);
        $("#groupNameInGroupInfoPage").text(j.obj.groupName);
        $("#createTimeInGroupInfoPage").text(j.obj.createTime);
        $("#groupNumInGroupInfoPage").text(j.obj.groupNum);
        $("#groupIntroInGroupInfoPage").text(j.obj.groupIntro);
        $(".weui_msg").hide();
        $("#groupInfoPage").show();
      }else{
        $.hideLoading();
        $.toast("查无此群", "forbidden");
      }
    }
  });
}
function showUpdateGroupPage() {
  $(".weui_msg").hide();
  var groupId = $("#groupIdInGroupInfoPage").text();
  var groupName = $("#groupNameInGroupInfoPage").text();
  var groupIntro = $("#groupIntroInGroupInfoPage").text();
  $("#groupIdInUpdateGroupPage").html(groupId);
  $("#groupNameInUpdateCreatePage").val(groupName);
  $("#groupIntroInUpdateCreatePage").val(groupIntro);
  $("#updateGroupPage").show();
}
function showMemberPage() {
  $.showLoading();
  var groupId = $("#groupIdInGroupInfoPage").text();
  $.ajax({
    type: "POST",
    url: "/index.php?c=groupApi&a=getMemberList",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupId:groupId
    },
    success: function (j) {
      if(j.ok == 0){
        var memberList = "";
        $.each(j.obj,function(n,value) {
          var list = "";
          list += "<a class='weui_cell'\"><div class='weui_cell_bd weui_cell_primary'><p align='left'>" + value.name +"</p></div></a>"
          memberList+=list;
        });
        $.hideLoading();
        $(".weui_msg").hide();
        $("#memberList").children().remove();
        $("#memberList").append(memberList);
        $("#memberPage").show();
      }else if(j.error == 0){
        $.hideLoading();
        $.alert(j.msg, "警告");
      }
    }
  });
}
function showHistoryMsgPage(groupId) {
  $.showLoading();
  if(!groupId){
    groupId = $("#groupIdInGroupInfoPage").text();
  }
  $.ajax({
    type: "POST",
    url: "/index.php?c=messageApi&a=getMsgList",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupId:groupId
    },
    success: function (j) {
      if(j.ok == 0){
        var msgList = "";
        $.each(j.obj,function(n,value) {
          var list = "";
          list += "<a class='weui_cell' onclick=\"showMsgInfoPage('"+ value.msgId +"')\"><div class='weui_cell_bd weui_cell_primary'><p align='left'>" + value.title +"</p></div></a>"
          msgList+=list;
        });
        $.hideLoading();
        $(".weui_msg").hide();
        $("#HisMsgList").children().remove();
        $("#HisMsgList").append(msgList);
        $("#historyMsgPage").show();
      }else if(j.error == 0){
        $.hideLoading();
        $.alert(j.msg, "警告");
      }
    }
  });
}
function showMsgInfoPage(msgId) {
  $.showLoading();
  $.ajax({
    type: "POST",
    url: "/index.php?c=messageApi&a=getMsgInfo",
    dataType: "json", //表示返回值类型，不必须
    data:{
      msgId:msgId
    },
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $("#groupIdInMsgInfoPage").text(j.obj.groupId);
        $("#titleInMsgInfoPage").text(j.obj.title);
        $("#startTimeInMsgInfoPage").text(j.obj.startTime);
        $("#addressInMsgInfoPage").text(j.obj.address);
        $("#introInMsgInfoPage").text(j.obj.intro);
        $("#createTimeInMsgInfoPage").text(j.obj.createTime);
        $("#blackBtnInMsgInfoPage").removeAttr("onclick");
        $("#blackBtnInMsgInfoPage").attr("onclick","blackHistoryMsgPage();");
        $(".weui_msg").hide();
        $("#msgInfoPage").show();
      }
    }
  });
}
function blackHistoryMsgPage() {
  $(".weui_msg").hide();
  $("#historyMsgPage").show();
}
function joinGroup(){
  $.prompt("","请输入你的名字", function(text) {
    var groupId = $("#groupIdInGroupInfoPage").text();
    var name = text;
    if(name == null){
      $.toast("请输入名字", "forbidden");
      return;
    }
    $.showLoading();
    $.ajax({
      type: "POST",
      url: "/index.php?c=groupApi&a=joinGroup",
      dataType: "json", //表示返回值类型，不必须
      data:{
        groupId : groupId,
        name : name
      },
      success: function (j) {
        if(j.ok == 0){
          $("#joinBtn").hide();
          $.hideLoading();
          $.toast("加入成功");
        }else if(j.error == 0){
          $("#joinBtn").hide();
          $.hideLoading();
          $.alert(j.msg, "警告");
        }else{
          $.hideLoading();
          $.toast("加入失败", "forbidden");
        }
      }
    });
  }, function() {
    showJoinGroupPage();
  });
}
function createGroup() {
  var groupName = $("#groupNameInCreatePage").val();
  var intro = $("#groupIntroInCreatePage").val();
  if(groupName.length > 20){
    $("#groupNameInCreatePage").val("");
    $.alert("群组名称不得超过20个字", "警告", function() {
      $("#groupNameInCreatePage").focus();
    });
    return;
  }
  if(intro.length > 200){
    $("#groupIntroInCreatePage").val("");
    $.alert("群组介绍不得超过200个字", "警告", function() {
      $("#groupIntroInCreatePage").focus();
    });
    return;
  }
  $.showLoading();
  $.ajax({
    type: "POST",
    url: "/index.php?c=groupApi&a=createGroup",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupName : groupName,
      intro : intro
    },
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $.alert(j.obj.groupId, "群号(长按复制)", function() {
          $("#joinBtn").hide();
          showGroupInfoPageByMyCreatePage(j.obj.groupId);
        });
      }else{
        $.hideLoading();
        $.toast("新建失败", "forbidden");
      }
    }
  });
}
function updateGroup() {
  var groupId = $("#groupIdInUpdateGroupPage").html();
  var groupName = $("#groupNameInUpdateCreatePage").val();
  var intro = $("#groupIntroInUpdateCreatePage").val();
  if(groupName.length > 20){
    $("#groupNameInCreatePage").val("");
    $.alert("群组名称不得超过20个字", "警告", function() {
      $("#groupNameInCreatePage").focus();
    });
    return;
  }
  if(intro.length > 200){
    $("#groupIntroInCreatePage").val("");
    $.alert("群组介绍不得超过200个字", "警告", function() {
      $("#groupIntroInCreatePage").focus();
    });
    return;
  }
  $.showLoading();
  $.ajax({
    type: "POST",
    url: "/index.php?c=groupApi&a=updateGroup",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupId : groupId,
      groupName : groupName,
      intro : intro
    },
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $.toast("修改成功");
        showGroupInfoPage(groupId);
      }else{
        $.hideLoading();
        $.toast(j.msg, "forbidden");
      }
    }
  });
}
function dropGroup() {
  var groupId = $("#groupIdInGroupInfoPage").html();
  $.prompt("请输入要解散的群组ID<br>(此操作无法恢复)","确认解散？", function(text) {
    if(text == groupId){
      $.showLoading();
      $.ajax({
        type: "POST",
        url: "/index.php?c=groupApi&a=dropGroup",
        dataType: "json", //表示返回值类型，不必须
        data:{
          groupId : groupId
        },
        success: function (j) {
          if(j.ok == 0){
            $.hideLoading();
            $.toast("删除成功");
            showMyCreatePage();
          }else{
            $.hideLoading();
            $.toast(j.msg, "forbidden");
          }
        }
      });
    } else {
      $.toast('群组ID不匹配', "forbidden");
    }
  }, function() {
    //点击取消后的回调函数
  });
}
function quitGroup() {
  var groupId = $("#groupIdInGroupInfoPage").html();
  $.confirm("确定退出吗？", function() {
    //点击确认后的回调函数
    $.showLoading();
    $.ajax({
      type: "POST",
      url: "/index.php?c=groupApi&a=quitGroup",
      dataType: "json", //表示返回值类型，不必须
      data:{
        groupId : groupId
      },
      success: function (j) {
        if(j.ok == 0){
          $.hideLoading();
          showMyGroupPage();
        }else{
          $.hideLoading();
          $.toast(j.msg, "forbidden");
        }
      }
    });
  }, function() {
    //点击取消后的回调函数
  });
}
function sendMsg() {
  var groupId = $("#groupIdInSendMsgPage").val();
  var msgTitle = $("#msgTitleInSendMsgPage").val();
  var startTime = $("#startTimeInSendMsgPage").val();
  var address = $("#addressInSendMsgPage").val();
  var intro = $("#introInSendMsgPage").val();
  $.showLoading();
  $.ajax({
    type: "POST",
    url: "/index.php?c=messageApi&a=sendMsg",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupId : groupId,
      title : msgTitle,
      startTime : startTime,
      address : address,
      intro : intro
    },
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $.toast("发送成功");
      }else{
        $.hideLoading();
        $.toast(j.msg, "forbidden");
      }
    }
  });
}
function updateName() {
  $.prompt("","请输入新的名字", function(text) {
    var groupId = $("#groupIdInGroupInfoPage").text();
    if(text == null){
      $.toast("请输入名字", "forbidden");
      return;
    }
    $.showLoading();
    $.ajax({
      type: "POST",
      url: "/index.php?c=groupApi&a=updateName",
      dataType: "json", //表示返回值类型，不必须
      data:{
        groupId : groupId,
        newName : text
      },
      success: function (j) {
        if(j.ok == 0){
          $.hideLoading();
          $.toast("修改成功");
        }else{
          $.hideLoading();
          $.toast("修改失败", "forbidden");
        }
      }
    });
  }, function() {
    showJoinGroupPage();
  });
}
