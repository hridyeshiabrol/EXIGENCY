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
$email=$_POST["txtemail"];
$address=$_POST["txtadd"];
    $stat=$_POST["txtstat"];
$city=$_POST["txtcity"];    
$shop=$_POST["txtshop"];    
$category=$_POST["txtcategory"];    
$special=$_POST["txtspec"];    
$exp=$_POST["txtexp"];    
$other=$_POST["txtother"];    

$orgName=$_FILES["profilePic"]["name"];
$tmpName=$_FILES["profilePic"]["tmp_name"];
$adharname=$_FILES["profilePics"]["name"];
$tmpname=$_FILES["profilePics"]["tmp_name"];


/*creating query-------------------------------------------*/
$query="insert into workers values('$uid','$name','$mobile','$email','$address','$stat','$city','$shop','$category','$special','$exp','$other', '$orgName','$adharname',0,0)";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	move_uploaded_file($tmpName,"workers/".$orgName);
    move_uploaded_file($tmpname,"aadhar/".$adharname);
	echo "<center><h3>Your data saved successfully</h3></center>";
}
else
	echo $msg;
}
/************************************update function**************************************************/
function doupdate($dbCon)

{
$uid=$_POST["txtuid"];
$name=$_POST["txtname"];
$mobile=$_POST["txtmob"];
$email=$_POST["txtemail"];
$address=$_POST["txtadd"];
$stat=$_POST["txtstat"];
$city=$_POST["txtcity"];    
$shop=$_POST["txtshop"];    
$category=$_POST["txtcategory"];    
$special=$_POST["txtspec"];    
$exp=$_POST["txtexp"];    
$other=$_POST["txtother"];
$hdn=$_POST["hdn"];
$hdnad=$_POST["hdnad"];
$orgName=$_FILES["profilePic"]["name"];
$tmpName=$_FILES["profilePic"]["tmp_name"];
       $adharname=$_FILES["profilePics"]["name"];
$tmpname=$_FILES["profilePics"]["tmp_name"];
    
    $size=$_FILES["profilePic"]["size"];
$type=$_FILES["profilePic"]["type"];
    
$size=$_FILES["profilePics"]["size"];
$type=$_FILES["profilePics"]["type"];
    
if($orgName=="")
	{
		$fileName=$hdn;
	}
	else 
	{
		$fileName=$orgName;
		move_uploaded_file($tmpName,"workers/".$orgName);
	}
    /*****************************************/
if($adharname=="")
	{
		$filename=$hdnad;
	}
	else 
	{
		$filename=$adharname;
		move_uploaded_file($tmpname,"aadhar/".$adharname);
	}
$query="update workers SET  name='$name',mobile='$mobile',email='$email',address='$address',city='$city',stat='$stat',city='$city',
shop='$shop',category='$category',special='$special',exp='$exp',other='$other',orgName='$fileName',adharname='$filename' where uid='$uid'";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	$rows=mysqli_affected_rows($dbCon);
    if($rows==0)
	echo"Not updated";
    else
    {
    echo "<center><h2>Your data is updated successfully.</h2></center>";
    }
}
else
	echo $msg;
}


?>
