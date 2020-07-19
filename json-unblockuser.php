<?php
include_once("connection.php");
$uid=$_GET["uid"];
$query="update users set status='1' where uid='$uid'";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
    echo "UNBLOCKED";
else
    echo $msg;
?>