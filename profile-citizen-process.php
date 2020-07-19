<?php

include_once("connection.php");
$btn=$_POST["btn"];
if($btn=="Save")
	doSave($dbCon);
else
    if($btn=="update")
    doupdate($dbCon);


function doSave($dbCon)
{
$uid=$_POST["txtuid"];
$name=$_POST["txtname"];
$mobile=$_POST["txtmob"];
$address=$_POST["txtadd"];
$city=$_POST["txtcity"];    
$stat=$_POST["txtstat"];
$email=$_POST["txtemail"];
$orgName=$_FILES["profilePic"]["name"];
$tmpName=$_FILES["profilePic"]["tmp_name"];
    $_SESSION["activeuser"]=$uid;

$query="insert into citizens values('$uid','$name','$mobile','$address','$city','$stat','$orgName','$email')";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	move_uploaded_file($tmpName,"upload/".$orgName);
	echo "<center><h3>Your data is saved successfully</h3></center>";
}
else
	echo $msg;
}

function doupdate($dbCon)

{
$uid=$_POST["txtuid"]; 
$name=$_POST["txtname"];
$mobile=$_POST["txtmob"];
$address=$_POST["txtadd"];
$city=$_POST["txtcity"];    
$stat =$_POST["txtstat"];

$orgName=$_FILES["profilePic"]["name"];
$tmpName=$_FILES["profilePic"]["tmp_name"];
$email=$_POST["txtemail"];

$size=$_FILES["profilePic"]["size"];
$type=$_FILES["profilePic"]["type"];
$hdn=$_POST["hdn"];
if($orgName=="")
	{
		$fileName=$hdn;
	}
	else
	{
		$fileName=$orgName;
		move_uploaded_file($tmpName,"upload/".$orgName);
	}

$query="update citizens SET  name='$name',mobile='$mobile',address='$address',city='$city',stat='$stat',pic='$fileName',email='$email' where uid='$uid'";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	$rows=mysqli_affected_rows($dbCon);
    if($rows==0)
	echo"Not updated";
    
    else
    {
    echo "<CENTER><h2>Your data is updated successfully.</h2></CENTER>";
    }
}
else
	echo $msg;
}
?>
