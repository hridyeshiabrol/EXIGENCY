<?php
	include_once("connection.php");
$uid=$_GET["uid"];

$query="select * from workers where uid='$uid'";
$table=mysqli_query($dbCon,$query);//table will have 0 or 1 record

$ary=array();//JSON-1

while($row=mysqli_fetch_array($table))
{
	
	$ary[]=$row;
}
echo json_encode($ary);
?>