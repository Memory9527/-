$(document).ready(function() {
    $("#name").focus(function(){
        $("#name").next().css("display","none");
    });

    $("#email").focus(function(){
        $("#email").next().css("display","none");
    });

    $("#message").focus(function(){
        $("#name").next().css("display","none");
    });

    $("#sub").click(function(){
        var name = $("#name").val();
        var email = $("#email").val();
        var message = $("#Message").val();

        if(name == ""){
            $("#name").next().css({"color":"red","margin":"15px 55px","display":"block"});
            $("#name").next().text("名字不能为空");
            return false;
        }else if (name.length >10){
            $("#name").next().css({"color":"red","margin":"15px 55px","display":"block"});
            $("#name").next().text("名字不能大于10字符");
            return false;
        }

        if(message == ""){
            $("#Message").next().css({"color":"red","margin":"15px 55px","display":"block"});
            $("#Message").next().text("内容不能为空");
            return false;

        }else if (name.length >50){
            $("#Message").next().css({"color":"red","margin":"15px 55px","display":"block"});
            $("#Message").next().text("名字不能大于10字符");
            return false;
        }

        var data={
            name : name,
            message : message,
            email : ""
        };
        if(email !== ""){
            var email_reg= /\w+([-+.]\w+)*@\w+([-.]\w+)*.\w+([-.]\w+)*/;
            if(!email_reg.test(email)){
                $("#email").next().css({"color":"red","margin":"15px 55px","display":"block"});
                $("#email").next().text("请输入正确邮箱");
                return false;
            }else {
                data.email = email;
            }
        }
        $.post('./post.php',data,function(data,textStatus,xhr){
            if(textStatus == 'success'){
               var data = $.parseJSON(data);
               if(data.error == '0') {
                   alert(data.msg);
                   window.location.href = '?page=1';
               } else {
                   alert(data.msg);
               }
           }
        });


    });



});
