<?php
session_start();
if($_GET['action']=="logout"){
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
    exit;
}

if(!isset($_POST['submit'])){
    exit('非法访问');
}
require_once(dirname(__FILE__).'./conn.php');
$name=$_POST['name'];
$password= $_POST['password'];
$password=MD5($password);
$name_check=mysqli_query($conn,"select uid from user WHERE username='$name' AND
 password='$password'");
if($reslut=mysqli_fetch_array($name_check)){
    $_SESSION['username']=$name;
    $_SESSION['userid']=$reslut['uid'];
    echo $name.'欢迎你进入<a href="my.php">用户中心</p><br>';
    echo '点击<a href="login.php?action=logout">注销</a>.注销登录';
}else{
    exit ("用户名或密码错误!<a href='#' onclick='javascript:history.back(-1)'>点击此处</a>重新登录");
}



