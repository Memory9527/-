<?php if (!defined('THINK_PATH')) exit();?><html>
<head></head>
<body></body>
    <form method="post" action="<?php echo U('show');?>" >
        <div>
            <label for="txtUserName">用户名:</label>
            <input type="text" id="txtUserName" name="txtUsername" minlength="2"/>
            <label for="txtUserPwd">密码:</label>
            <input type="password" id="txtUserPwd" name="txtUserPwd" />
            <label for="txtValidateCode">验证码:</label>
            <input type="text" id="txtValidateCode" name="txtValidateCode" />
            <img src="<?php echo U('verify');?>" style="cursor: pointer" title="看不清，点击换" alt="看不清，换"
            onclick="this.src=this.src+'?time='+Math.random()">
        </div>
        </form>
</html>>