$(document).ready(function(){

    $("#admin").focus(function(){
        $("#admin").next().css("display","none");
        $("#error").css("display","none");
    });

    $("#password").focus(function(){
        $("#password").next().css("display","none");
        $("#error").css("display","none");
    });


    $("#sub").click(function(){
        var name = $("#admin").val();
        var pwd = $("#password").val();
        if(name == ""){
            $("#admin").next().css({"display":"block","color":"red"});
            $("#admin").next().text("名字不能为空");
            return false;
        }

        if(pwd == ""){
            $("#password").next().css({"display":"block","color":"red"});
            $("#password").next().text("密码不能为空");
            return false;
        }

        var data={
          name : name,
          pwd  : pwd
        };

        $.post("./login.php",data,function(data,textStatus,xhr){
           if(textStatus == 'success'){
               var data = $.parseJSON(data);
              if(data.error == '0'){
                   alert(data.msg);
                  window.location="admin.php";
              }else {
                  $("#error").css({"display":"inline-block","color":"red"});
                  $("#error").text(data.msg);
              }
           }


        });

    });
});