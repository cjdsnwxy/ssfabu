$(document).ready(function(){

  $("#showIndexBtn").click(function (){
    showIndexPage();
  });

  $("#joinGroupBtn").click(function(){
    showJoinGroupPage();
  });

  $("#myGroupBtn").click(function(){
    showMyGroupPage();
  });

  $("#myCreateBtn").click(function(){
    showMyCreatePage();
  });

  $("#createGroupBtn").click(function(){
    showCreateGroupPage();
  });

  $("#datetime-picker").datetimePicker();


});

function showIndexPage(){
  $("#joinGroupPage").hide();
  $("#myGroupPage").hide();
  $("#myCreatePage").hide();
  $("#createGroupPage").hide();
  $("#indexPage").show();
}

function showJoinGroupPage(){
  $("#indexPage").hide();
  $("#myGroupPage").hide();
  $("#myCreatePage").hide();
  $("#createGroupPage").hide();
  $("#joinGroupPage").show();
}

function showMyGroupPage(){
  $("#joinGroupPage").hide();
  $("#indexPage").hide();
  $("#myCreatePage").hide();
  $("#createGroupPage").hide();
  $("#myGroupPage").show();
}

function showMyCreatePage(){
  $("#joinGroupPage").hide();
  $("#myGroupPage").hide();
  $("#indexPage").hide();
  $("#createGroupPage").hide();
  $("#myCreatePage").show();
}

function showCreateGroupPage(){
  $("#joinGroupPage").hide();
  $("#myGroupPage").hide();
  $("#myCreatePage").hide();
  $("#indexPage").hide();
  $("#createGroupPage").show();
}

