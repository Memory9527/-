<?php
session_start();
if(!$_SESSION['admin']){
    return false;
}
$id = $_POST['id'];
$status = $_POST['status'];

require '../config.php';
require '../mysql.class.php';
DB::connect();
if(empty($id)||!is_numeric($id)){
    exit;
}
$status == 0 ? $status=1 : $status=0;

$update_sql = 'UPDATE ' . DB_TABLE_NAME . ' SET status="' . $status .'" WHERE id="' .$id .'"';
$update_status = mysqli_query(DB::$con,$update_sql);
DB::close();

if($update_status){
    if($status==0){
        echo json_encode(["error"=>"0","msg"=>"unlock success"]);
    }else{
        echo json_encode(["error"=>"0","msg"=>"lock success"]);
    }
}else{
    echo json_encode(["error"=>1,"msg"=>"failed"]);
}
