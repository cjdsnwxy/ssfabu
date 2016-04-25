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

function showSuccessPage() {
  $(".weui_msg").hide();
  $("#successPage").show();
}

function showGroupInfoPageByJoinBtn(){
  $("#joinBtn").show();
  var groupId = $("#joinGroupId").val();
  if(groupId.length == 0 || isNaN(groupId)) {
    $.alert("请出入正确的群组ID", "警告", function() {
      $("#joinGroupId").focus();
    });
  } else {
    $.showLoading();
    setTimeout(function () {
      $.hideLoading();
      $(".weui_msg").hide();
      $("#groupInfoPage").show();
    }, 2000);

  }
}



function showGroupInfoPage(obj){

}
function joinGroup(){
  $.showLoading();
  setTimeout(function () {
    $.hideLoading();
    $("#joinBtn").hide();
    $.toast("加入成功");
  }, 2000);
}
function createGroup() {

  var groupName = $("#groupNameInCreatePage").val();
  var intro = $("#groupIntroInCreatePage").val();
  $.showLoading();
  $.ajax({
    type: "POST",
    url: "http://www.demo.com/index.php?c=index&a=createGroup",
    dataType: "json", //表示返回值类型，不必须
    data:{
      groupName : groupName,
      intro : intro
    },
    success: function (j) {
      if(j.ok == 0){
        $.hideLoading();
        $.alert(j.obj.groupId, "新建群号");
      }else{
        $.hideLoading();
        $.toast("新建失败", "forbidden");
      }
    }
  });



}
