<?php
$userid=$_GET["uid"];
include_once("connection.php");
$query="select * from users where uid='$userid'";
$table=mysqli_query($dbCon,$query);//0-1
if(mysqli_num_rows($table)==1)
	echo "AVALIABLE USER";
else
	echo "NEW USER";
?>