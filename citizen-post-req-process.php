<?php
include_once("connection.php");

$uid=$_GET["uid"];
$category=$_GET["category"];
$problem=$_GET["problem"];
$location=$_GET["location"];
$city=$_GET["city"];

$query="insert into requirements(rid,uid,category,problem,location,city,dop) values(default,'$uid','$category','$problem','$location','$city',CURDATE())";

mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	echo "<H6>Your requirement posted</H6>";
}
else
	echo $msg;
?>
