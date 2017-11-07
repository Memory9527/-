    <?php
if(!isset($_POST['submit'])){
    exit("非法访问");
}
$name=$_POST['name'];
$pwd=$_POST['password'];
echo $password;
$email=$_POST['email'];

require_once (dirname(__FILE__).'./conn.php');
//检测用户名是否存在
$check_name = mysqli_query($conn,"select uid from user WHERE username='$name' limit 1");
if(mysqli_fetch_array($check_name)){
    echo '错误:用户名'.$name.'已存在
    <a href="#" onClick="javascript:history.back(-1);">返回</a>';
}

$pwd=MD5($pwd);
$regdate=time();

$sql="insert into user(username,password,email,regdate)
VALUES ('$name','$pwd','$email','$regdate')";
if(mysqli_query($conn,$sql)){
    exit('用户注册成功!点击<a href="login.html">登录</a>');
}else{
    echo '添加失败'.mysqli_error($conn);
    echo '点击此处 <a href="#" onclick="javascript:history.back(-1)">重新注册</a>';
}