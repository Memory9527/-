<?php
session_start();

if(!isset($_SESSION['userid'])){
    header("Location:login.html");
    exit();
}

require_once(dirname(__FILE__).'./conn.php');
$userid=$_SESSION['userid'];
$username=$_SESSION['username'];
$user_query=mysqli_query($conn,"select * from user WHERE uid=$userid limit 1");
$row=mysqli_fetch_array($user_query);
echo '用户信息:<br>';
echo '用户id:'.$userid.'<br>';
echo '用户名:'.$username.'<br>';
echo '用户邮箱'.$row['email'].'<br>';
echo '注册时间'.date("Y-m-d",$row['regdate']).'<br>';
echo '<a href="login.php?action=logout">注销</a>';