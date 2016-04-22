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
  $(".weui_msg").hide();
  $("#myGroupPage").show();
}

function showMyCreatePage(){
  $(".weui_msg").hide();
  $("#myCreatePage").show();
}

function showCreateGroupPage(){
  $(".weui_msg").hide();
  $("#createGroupPage").show();
}

function showGroupInfoPage(){
  var groupId = $("#joinGroupId").val();
  if(groupId.length == 0 || isNaN(groupId)) {
    $.alert("请出入正确的群组ID", "警告", function() {
      $("#joinGroupId").focus();
    });
  } else {
    $(".weui_msg").hide();
    $("#groupInfoPage").show();
  }
}

function joinGroup(){

}
