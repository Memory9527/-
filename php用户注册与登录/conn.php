<?php
$servername='localhost';
$username="root";
$password="windows@123";
$dbname=user;

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(mysqli_connect_errno($conn)){
    echo "ERROR:".mysqli_connect_error();
}


