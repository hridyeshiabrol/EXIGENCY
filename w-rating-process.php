<?php
include_once("connection.php");

$citizenuid=$_GET["citizenuid"];
$workeruid=$_GET["workeruid"];

$query="insert into ratings(rid,citizenuid,workeruid) values(default,'$citizenuid','$workeruid')";

mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	echo "<H6>Request Sent</H6>";
}
else
	echo $msg;
?>
