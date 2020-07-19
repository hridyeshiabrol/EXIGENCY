<?php
include_once("connection.php");
$rid=$_GET["rid"];
$query="delete from requirements where rid='$rid' ";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
    echo "Post Deleted";
else
    echo $msg;
?>