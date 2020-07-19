<?php
	include_once("connection.php");
$category=$_GET["category"];
$city=$_GET["city"];
$query="select * ,DATE_FORMAT(DATE_ADD(dop,INTERVAL 10 DAY),'%d-%M-%y') as deadline from requirements where
abs(DATEDIFF(curdate(),dop))<10 and category='$category' and city='$city'";
$table=mysqli_query($dbCon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
	
	$ary[]=$row;
}
echo json_encode($ary);
?>