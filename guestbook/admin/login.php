<?php
require '../config.php';
require '../mysql.class.php';

if(empty($_POST['name'])||empty($_POST['pwd'])){
    header('location:index.html');
}

DB::connect();
$name = DB::$con->real_escape_string($_POST['name']);
$pwd = DB::$con->real_escape_string($_POST['pwd']);
$pwd_sql = ('SELECT password from ' . ADMIN_TABLE_NAME .
        ' WHERE level=9 AND nickname = ' . "'{$name}'" . ' LIMIT 1 ');
$pwd_status = mysqli_query(DB::$con,$pwd_sql);
$password = mysqli_fetch_array($pwd_status)[0];
DB::close();
if(md5($pwd) == $password){
    session_start();
    $_SESSION['admin'] = true;
    echo json_encode(['error'=>'0','msg'=>'登录成功']);
}else{
    echo json_encode(['error'=>'1','msg'=>'用户名或密码错误']);
}
