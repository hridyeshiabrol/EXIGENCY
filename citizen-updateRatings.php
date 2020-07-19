<?php
include_once("connection.php");
$uid=$_GET["uid"];
$total=$_GET["total"];
$query="update workers set total= total+'$total' ,count=count+1  where uid='$uid'";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	echo "ok";
}
else
	echo $msg;

?>
