<?php
	include_once("connection.php");
$category=$_GET["category"];
$city=$_GET["city"];

$query="select * from workers where category='$category' and city='$city'";
//$query="select * from workers where  city='$city'";
$table=mysqli_query($dbCon,$query);//table will have 0 or 1 record

$ary=array();//JSON-1

while($row=mysqli_fetch_array($table))
{
	
	$ary[]=$row;
}
echo json_encode($ary);
?>