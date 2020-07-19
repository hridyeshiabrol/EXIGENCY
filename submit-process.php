<?php
include_once("connection.php");

$uid=$_GET["uid"];
$pass=$_GET["pass"];
$mobile=$_GET["mobile"];
$category=$_GET["category"];

$query="insert into users(uid,pass,mobile,category,curdate) values('$uid','$pass','$mobile','$category',CURDATE())";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	echo "You are signed up successfully!";
}
else
	echo $msg;
?>
