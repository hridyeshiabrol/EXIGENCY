<?php
	include_once("connection.php");
$query="select distinct category  from requirements";
$table=mysqli_query($dbCon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
	$ary[]=$row;
}
echo json_encode($ary);
?>