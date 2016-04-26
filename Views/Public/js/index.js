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
        $("#joinBtn").hide();
        $.hideLoading();
        $.toast("加入成功");
      }else if(j.error == 0){
        $("#joinBtn").hide();
        $.hideLoading();
        $.alert("您已经在群组中了。", "警告");
      }else{
        $.hideLoading();
        $.toast("加入失败", "forbidden");
      }
    }
  });
}
function showMyCreatePage(){
  $(".weui_msg").hide();
  $("#myCreatePage").show();
}
function showCreateGroupPage(){
  $("#groupNameInCreatePage").val("");
  $("#groupIntroInCreatePage").val("");
  $(".weui_msg").hide();
  $("#createGroupPage").show();
}

function showSuccessPage() {
  $(".weui_msg").hide();
  $("#successPage").show();
}

function showGroupInfoPage(groupId){
  $.showLoading();
  $.ajax({
    type: "POST",
    url: "/index.php?c=index&a=findGroup",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupId : groupId
    },
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $(".weui_msg").hide();
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
        showIndexPage();
      }
    }
  });

}
function showGroupInfoPageByJoinBtn(){
  $("#joinBtn").show();
  var groupId = $("#joinGroupId").val();
  if(groupId.length == 0 || isNaN(groupId || groupId.length > 8)) {
    $.alert("请出入正确的群组ID", "警告", function() {
      $("#joinGroupId").focus();
    });
  } else {
    showGroupInfoPage(groupId);
  }
}

function joinGroup(){
  $.showLoading();
  var groupId = $("#groupIdInGroupInfoPage").text();
  $.ajax({
    type: "POST",
    url: "/index.php?c=index&a=joinGroup",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupId:groupId
    },
    success: function (j) {
      if(j.ok == 0){
        $("#joinBtn").hide();
        $.hideLoading();
        $.toast("加入成功");
      }else if(j.error == 0){
        $("#joinBtn").hide();
        $.hideLoading();
        $.alert("您已经在群组中了。", "警告");
      }else{
        $.hideLoading();
        $.toast("加入失败", "forbidden");
      }
    }
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
    url: "/index.php?c=index&a=createGroup",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupName : groupName,
      intro : intro
    },
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $.alert(j.obj.groupId, "群号(长按复制)", function() {
          showIndexPage();
        });
      }else{
        $.hideLoading();
        $.toast("新建失败", "forbidden");
      }
    }
  });
}
