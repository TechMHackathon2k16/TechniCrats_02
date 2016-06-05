<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="description" content="ParkAlert , It is free of cost, hassle free and a great way to relieve you of the stress of hunting for the owner of the wrongfully parked vehicle!!.With the increase in the number of cars, the problem of parking them has increased manifolds. ParkAlert is your goto solution for all parking related issues. A concept that has never been implemented before, parkalert ensures your parking space remians yours only.">
    <meta name="author" content="DIVYANSH">
	<meta name="publisher" content="www.parkalert.xyz">
	<meta name="copyright" content="www.parkalert.xyz">
	<meta name="host" 	   content="www.parkalert.xyz">
	<meta name="robots" content="noodp, noydir">
	<meta name="robots" content="index, follow">
	
	        <!--favicon-->
        <link rel='apple-touch-icon'   sizes='57x57' href='favicon/apple-touch-icon-57x57.png'>
        <link rel='apple-touch-icon'   sizes='60x60' href='favicon/apple-touch-icon-60x60.png'>
        <link rel='apple-touch-icon'   sizes='72x72' href='favicon/apple-touch-icon-72x72.png'>
        <link rel='apple-touch-icon' sizes='114x114' href='favicon/apple-touch-icon-114x114.png'>
        <link rel='apple-touch-icon' sizes='144x144' href='favicon/apple-touch-icon-144x144.png'>
        <link rel='apple-touch-icon' sizes='180x180' href='favicon/apple-touch-icon-180x180.png'>
        <link rel='icon' type='image/png' href='favicon/favicon-32x32.png' sizes='32x32'>
        <link rel='icon' type='image/png' href='favicon/android-chrome-192x192.png' sizes='192x192'>
        <link rel='icon' type='image/png' href='favicon/favicon-96x96.png' sizes='96x96'>
        <link rel='icon' type='image/png' href='favicon/favicon-16x16.png' sizes='16x16'>
	<link rel="shortcut icon" href="favicon/favicon-32x32.png" type="image/x-icon" />
	<title>ParkAlert</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>

</head>
<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF']))
	{
		die();
	}
?>
<?php if(isUserLoggedIn())
{
 require_once("models/top-nav.php");
}
 ?>
<body>
 	<div class="container-fluid" style="height:100vh; font-family: Comic Sans MS; background-image:url(texture.png)">
		<div class="row">
<?php

$conn = new mysqli('localhost','root','','userspice');
//echo $_GET['search'];
		
$sql="select * from us_users where Car_Number = '".$_POST['search']."'";
		$result = $conn->query($sql);
		if($result->num_rows >0){
	

	while ( $row = $result->fetch_assoc()){
				$r = $row["Mobile_Number"];
				$user_name = $row["user_name"];
				$Car_Number = $row["Car_Number"];
			}
		}
		?>
	<!--	Name : 		<?php//  echo ''.$user_name.'';?>	<br/>
		Mobile:		<?php // echo ''.$r.'';?>		<br/>
		Car Number:	<?php // echo ''.$Car_Number.'';?><br/>
		<hr/>
		-->
		
			<?php
		$usercarnumber = $loggedInUser->carnumber;
	
// Replace with your username
$user = "minnitiwari3";

// Replace with your API KEY (We have sent API KEY on activation email, also available on panel)
$apikey = "vJblDtlgdNlViw7Om9eI"; 

// Replace if you have your own Sender ID, else donot change
$senderid  =  "ParkAlert"; 

		
// Replace with the destination mobile Number to which you want to send sms
$mobile  =  $r; 

// Replace with your Message content
$message   = "Dear " .$user_name. " , Your Car Number is " .$Car_Number. " , Affected_User Car Number ".$usercarnumber."  Your Car Is Parked on wrong area. Other are facing Problem to Park their Car. 
Immediately go to your car and park Somewhere Else"; 
$message = urlencode($message);

// For Plain Text, use "txt" ; for Unicode symbols or regional Languages like hindi/tamil/kannada use "uni"
$type   =  "txt";

$ch = curl_init("http://smshorizon.co.in/api/sendsms.php?user=".$user."&apikey=".$apikey."&mobile=".$mobile."&senderid=".$senderid."&message=".$message."&type=".$type.""); 
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);      
    curl_close($ch); 
?> 
		<?php
		$conn = new mysqli('localhost','root','','userspice');
		$Sender_Username = $loggedInUser->displayname ;
		
		$sql = "INSERT INTO message_data (Sender_Username, Receiver_Username, Car_Number, Mobile_Number)
				VALUES ('$Sender_Username', '$user_name', '$Car_Number', '$r')";
		$conn->query($sql);

		$r = $conn->query("select * from (select * from message_data where Sender_Username = '$Sender_Username' ORDER BY id DESC LIMIT 3 ) t ORDER by id ASC");
		//var_dump($r);		
		?>
		<table class="table table-striped table-bordered" class="container">
                  <thead>
                    <tr>
                      <th>Receiver Username</th>
                      <th>Car Number</th>
                    </tr>
                  </thead>
                  <tbody>
		<?php
	
		for($i = 0; $i < $r->num_rows; $i++){
			$row = $r->fetch_array(MYSQLI_ASSOC);
			
			echo "<tr align='center'>";
			echo '<tr>';
				echo "<td>".$row["Receiver_Username"]."</td>";
				echo "<td>".$row["Car_Number"]."</td>";
			echo "</tr>";
		}
		
		?>
		                </tbody>

            </table>

        </div>

    </div> <!-- /container -->
		
<br/>
<?php
// Display MSGID of the successful sms push
//echo $output;


// Redirect the abc.php page to the Account.php Page
/*
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
 header("Location: login.php");
	die(); 
} */

?>




