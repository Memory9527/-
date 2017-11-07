<?php
require '../config.php';
require '../mysql.class.php';
session_start();
if(!$_SESSION['admin']){
    return false;
}

DB::connect();
$id = isset($_POST['id']) ? DB::$con->real_escape_string($_POST['id']) : exit("no user");
$reply = isset($_POST['reply']) ? DB::$con->real_escape_string($_POST['reply']) : exit("no reply");
$time = date('Y-m-d H:i:s',time());
$update_sql = 'UPDATE ' . DB_TABLE_NAME . ' SET reply = "' . $reply . '", replytime = "' . $time .'" WHERE id = ' . $id;
$update_status = mysqli_query(DB::$con,$update_sql);
DB::close();
if($update_status){
    echo json_encode(["error"=>"0","msg"=>"success"]);
}else{
    echo json_encode(["error"=>"1","msg"=>"reply failed"]);
}