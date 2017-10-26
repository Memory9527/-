function $(id){
    return document.getElementById(id);
}

window.onload = function() {
    var Name = $("name");
    var pwd = $("password");
    var sub = $("submit");

//提交检测
    sub.onclick = function() {
        if(checkName()&&checkPwd()){
            return true;
        }else{
            return false;
        }
    }


//名称检测
    Name.onfocus=Name.onblur=function(evt){
        var evt = evt || window.event;
        checkName(evt);
    }

    function checkName(evt){
        var type;
        if(evt){
            type=evt.type;
        }
        var value=Name.value;
        var box=Name.parentNode;
        var tip=box.nextElementSibling;
        var span=tip.lastElementChild;
        if(type=="focus"){
            if(value==""){
                box.className = "box";
                tip.className = "tip default";
                span.innerHTML="请输入用户名";
                return false;
            }
        }

        if(type=="blur"){
                box.className = "box";
                tip.className = "tip hide";
                return false;
        }
        if(value == ""){
            box.className="box error";
            tip.className = "tip error";
            span.innerHTML= "用户名不能为空";
            return false;
        }else{
            return true;
        }

    }

//密码检测
pwd.onfocus=pwd.onblur=function(evt){
        var evt = evt || window.event;
        checkPwd(evt);
    }

    function checkPwd(evt){
        var type;
        if(evt){
            type=evt.type;
        }

        var value = pwd.value;
        var box = pwd.parentNode;
        var tip = box.nextElementSibling;
        var span = tip.lastElementChild;


        if(type=="focus"){
            if(value==""){
                box.className="box";
                tip.className="tip default";
                span.innerHTML="请输入密码";
                return false;
            }
        }
        if(type=="blur"){
                box.className="box";
                tip.className="tip hide";
                return false;
        }
        if(value==""){
            box.className="box error";
            tip.className="tip error";
            span.innerHTML="密码不能为空";
            return false;
        }else {
            return true;
        }
    }


}