<?php

function SendSMS($mobilenumbers,$message)
{
	$user="bcebti"; //your username
	$password="909938537"; //your password
	$senderid="SUNSFT"; //Your senderid
	//$url="http://smsapple.in/api/swsend.asp";//URL To HIT
	$url=	"http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp";//?username="+uid+"&password="+pwd+"&sendername="+sender+"&mobileno="+mobileno+"&message="+msg;
	$message = urlencode($message);
	$ch = curl_init();
	if (!$ch){die("Couldn't initialize a cURL handle");}
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt ($ch, CURLOPT_POSTFIELDS,
	"username=$user&password=$password&sendername=$senderid&mobileno=$mobilenumbers&message=$message");
	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$curlresponse = curl_exec($ch); // execute
	if(curl_errno($ch))
	echo "";
	//echo 'curl error : '. curl_error($ch);
	if (empty($ret)) 
		{
			// some kind of an error happened
			//die(curl_error($ch));
			curl_close($ch); // close cURL handler
		} 
	else 
		{
			$info = curl_getinfo($ch);
			curl_close($ch); // close cURL handler
			return $curlresponse; 
		}
}
?>