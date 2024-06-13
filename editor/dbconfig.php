<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_USER_NOTICE);
$hostname="localhost";
$userName = "root";
$password = "";
$databaseName = "dynamicportfolio"; 
$conn = mysqli_connect($hostname, $userName, $password,$databaseName);
if(!$conn){
    echo "Error While Connecting Database :".mysqli_connect_error();
}
?>