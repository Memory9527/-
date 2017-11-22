<?php
//用户登录界面
require 'header.php';

echo "<div class='main'><h3>Please enter your details to log in</h3>";
$error = $user = $pass = "";
if(isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    if($user==""||$pass=="")
        $error = "Not all fields were entered<br>";
    else
    {
        $pass = md5($pass);
        $result = queryMysql("SELECT pass FROM members WHERE user='$user'");
        $pwd = $result->fetch_array()[0];
        if($pass==$pwd){
            $_SESSION['user']=$user;
            $_SESSION['pass']=$pass;
            die("You are now logged in. Please <a href='members.php?view=$user'>" .
                "click here</a> to continue.<br><br>");
        }else{
            $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
        }

    }


}

echo <<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username</span>
    <input type='text' maxlength='16' name='user' value='$user'
    onBlur='checkUser(this)' /><span id='info'></span><br>
    <span class='fieldname'>Password</span>
    <input type="password" maxlength='16' name='pass' value='$pass' />
    <br>
_END;
?>
<span class="fieldname">&nbsp;</span>
<input type="submit" value="Sign up">
</form></div><br>
</body>
</html>

