<?php

$Message = $_POST['message'];
$conn = new mysqli('localhost','root','','userspice');

	$r = $conn->query("select * from us_users");
		//var_dump($r);		

	
		for($i = 0; $i < $r->num_rows; $i++){
			$row = $r->fetch_array(MYSQLI_ASSOC);
			
			$mobilenumber = $row["Mobile_Number"];
			
			
$user = "minnitiwari3";

// Replace with your API KEY (We have sent API KEY on activation email, also available on panel)
$apikey = "vJblDtlgdNlViw7Om9eI"; 

// Replace if you have your own Sender ID, else donot change
$senderid  =  "Testing"; 

// Replace with the destination mobile Number to which you want to send sms
$mobile  =  $mobilenumber; 

// Replace with your Message content
$message = $Message;
$message = urlencode($message);

// For Plain Text, use "txt" ; for Unicode symbols or regional Languages like hindi/tamil/kannada use "uni"
$type   =  "txt";

$ch = curl_init("http://smshorizon.co.in/api/sendsms.php?user=".$user."&apikey=".$apikey."&mobile=".$mobile."&senderid=".$senderid."&message=".$message."&type=".$type.""); 
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);      
    curl_close($ch);
				
		}

//Redirect to the message data page to display the sent message
if(!empty($websiteUrl))
{
	$add_http = "";

	if(strpos($websiteUrl,"http://") === false)
	{
		$add_http = "http://";
	}

	header("location: account.php");
	die();
}
else
{
 header("Location: account.php");
	die(); 
}
?>