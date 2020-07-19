<?php

session_start();//creates session array
include_once("connection.php");

$uid=$_GET["uid"];
$pass=$_GET["pass"];

$query="select * from users where uid='$uid' && pass='$pass' and status=1 " ;    
$table=mysqli_query($dbCon,$query);
$count=mysqli_num_rows($table);

if($count==1)
{
    $row=mysqli_fetch_array($table);
    $categoryy=$row["category"];
    $_SESSION["activeuser"]=$uid;
    echo $categoryy;
    //$_SESSION["activeuser"]=$uid;

}
else
    echo  "PLEASE NOTE:-
    WWW.EXIGENCY.COM BLOCKED YOU FROM THEIR SITE";

?>