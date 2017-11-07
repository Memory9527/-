<?php
require 'config.php';
require 'mysql.class.php';
header("Content-Type: text/html;charset=utf-8");
DB::connect();
$name = DB::$con->real_escape_string($_POST['name']);
$message = DB::$con->real_escape_string($_POST['message']);
if(empty($name) || empty($message)){
    exit('{"error":"1","msg":"名字和内容不能为空"}');
}
if(mb_strlen($name)>10 || mb_strlen($message)>50){
    exit('{"error":"1","msg":"名字长度超过10或者内容长度超过50"}');
}

if(!empty($_POST['email'])){
    $email = DB::$con->real_escape_string($_POST['email']);
    $email_reg = '/\w+([-+.]\w+)*@\w+([-.]\w+)*.\w+([-.]\w+)*/';
    if(!preg_match($email_reg,$email)){
        exit('{"error":"1","msg":"邮箱不合法"}');
    }
}else{
    $email = '';
}
$create_time = date('Y-m-d H:i:s',time());
$sql_insert = 'insert into ' . DB_TABLE_NAME . ' (nickname,content,createtime,
email) value( ' . "'{$name}', '{$message}', '{$create_time}', '{$email}')";
$insert_status = mysqli_query(DB::$con,$sql_insert);
DB::close();
if($insert_status){
    echo json_encode(['error'=>'0','msg'=>'Success message']);
}else{
    echo json_encode(['error'=>'1','msg'=>'Message failed']);
}


