<?php

include_once("connectivity.php");
$uid=$_GET["uid"];
$total=$_GET["total"];
$query="update workers set total= total+'$total' ,count=count+1  where uid='$uid'";
mysqli_query($db,$query);
$msg=mysqli_error($db);
if($msg=="")
{
	
	echo "ok";
}
else
	echo $msg;

?>
