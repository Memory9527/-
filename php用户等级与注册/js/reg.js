function $(id){
    return document.getElementById(id);
}

var regs = {
    NameReg: /^(([\u4e00-\u9fa5])|[a-zA-Z0-9-_]){4,20}$/,
    pwdReg: /^.{6,20}$/,
    emailReg: /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/,
    numReg: /\d/,
    strReg: /[a-zA-Z]/,
    tsReg: /[^\u4e00-\u9fa5a-zA-Z0-9]/
}

window.onload = function() {
    var Name = $("name");
    var pwd = $("password");
    var pwd2 = $("repassword");
    var email = $("email");
    var ck = $("ck");
    var sub = $("submit");

//提交检测
    sub.onclick = function() {
        var box = ck.parentNode;
        var tip = box.nextElementSibling;
        var span = tip.lastElementChild;
        if(ck.checked){
            if(checkName()&&checkPwd()&&checkPwd2()&&checkEmail()){
                return true;
            }else{
                return false;
            }
        }else{
            tip.className = "tip error";
            span.innerHTML = "请同意协议";
            return false;
        }
    }

//名称检测
    Name.onkeyup=Name.onfocus=Name.onblur=function(evt){
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
                span.innerHTML="支持汉字、字母、数字、“-”“_”的组合，4-20个字符";
                return false;
            }
        }

        if(type=="blur"){
            if(value==""){
                box.className = "box";
                tip.className = "tip hide";
                return false;
            }
        }
        if(value == ""){
            box.className="box error";
            tip.className = "tip error";
            span.innerHTML= "用户名不能为空";
            return false;
        }else if(regs.NameReg.test(value)){
            box.className="box right";
            tip.className="tipe hide";
            return true;
        }else{
            box.className = "box error";
            tip.className = "tip error";
            span.innerHTML = "格式错误，仅支持4-20位汉字、字母、数字、“-”“_”的组合";
            return false;
        }

    }

//密码检测
    pwd.onkeyup=pwd.onfocus=pwd.onblur=function(evt){
        var evt = evt || window.event;
        checkPwd(evt);
    }

    function getPwdLevel(pwd){
        //密码级别
        var level=0;
        var numReg=true,strReg=true,tsReg=true;
        for(var i=0;i<pwd.length;i++){
            if(numReg&&regs.numReg.test(pwd)){
                level++;
                numReg=false;
            }
            if(strReg&&regs.strReg.test(pwd)){
                level++;
                strReg=false;
            }
            if(tsReg&&regs.tsReg.test(pwd)){
                level++;
                tsReg=false
            }
        }
        return level;
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
                span.innerHTML="建议使用字母、数字和符号两种以上的组合,6-20个字符";
                return false;
            }
        }
        if(type=="blur"){
            if(value==""){
                box.className="box";
                tip.className="tip hide";
                return false;
            }
        }
        if(value==""){
            box.className="box error";
            tip.className="tip error";
            span.innerHTML="密码不能为空";
            return false;
        }else if(regs.pwdReg.test(value)){
            box.className = "box right";
            var level = getPwdLevel(value);
            switch (level){
                case 1:
                    tip.className="tip ruo";
                    span.innerHTML="密码强度弱";
                    break;
                case 2:
                    tip.className="tip zhong";
                    span.innerHTML="密码强度中";
                    break;
                case 3:
                    tip.className="tip qiang";
                    span.innerHTML="密码强度强";

            }
            return true;
        }else {
            box.className="box error";
            tip.className="tip error";
            span.innerHTML="请输入6-20位字符作为密码";
            return false;
        }
    }
    //再次确认密码
    pwd2.onkeyup=pwd2.onfocus=pwd2.onblur=function(evt){
        var evt = evt || window.event;
        checkPwd2(evt);
    }
    function checkPwd2(evt){
        var type;
        if(evt){
            type=evt.type;
        }
        var value1=pwd.value;
        var value2=pwd2.value;
        var box=pwd2.parentNode;
        var tip=box.nextElementSibling;
        var span=tip.lastElementChild;
        if(type=="focus"){
            if(value2==""){
                box.className="box";
                tip.className="tip default";
                span.innerHTML = "请再次输入密码";
                return false;
            }
        }
        if(value2==""){
            box.className="box error";
            tip.className="tip error";
            span.innerHTML="请再次输入密码";
            return false;

        }else if(value1==value2){
            box.className="box right";
            tip.className="tip hide";
            return true;
        }else {
            box.className="box error";
            tip.className="tip error";
            span.innerHTML="两次密码不一致";
            return false;
        }
    }
    //检测邮箱
    email.onfocus=email.onblur=function(evt){
        var evt = evt || window.event;
        checkEmail(evt);
    }

    function checkEmail(evt){
        var type;
        if(evt){
            type=evt.type;
        }
        var value=email.value;
        var box=email.parentNode;
        var tip=box.nextElementSibling;
        var span=tip.lastElementChild;
        if(type=="focus"){
            if(value==""){
                box.className="box";
                tip.className="tip default";
                span.innerHTML="请输入邮箱";
                return false;
            }
        }

        if(type=="blur"){
            if(value==""){
                box.className="box";
                tip.className="tip hide";
                return false;
            }else if(regs.emailReg.test(value)){
                box.className="box right";
                tip.className="tip hide";
                return true;
            }else {
                box.className="box error";
                tip.className="tip error";
                span.innerHTML="格式有误";
                return false;
            }
        }
        if(value==""){
            box.className="box error";
            tip.className="tip error";
            span.innerHTML="请输入邮箱";
            return false;
        }else if(regs.emailReg.test(value)){
            return true;
        }
    }
    //确认协议
    ck.onclick = function(){
        var box = ck.parentNode;
        var tip = box.nextElementSibling;
        var span = tip.lastElementChild;
        if(ck.checked){
            tip.className="tip hide";
        }
    }
}