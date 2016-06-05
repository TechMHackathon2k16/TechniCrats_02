<?php


require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Log the user out
if(isUserLoggedIn())
{
	$loggedInUser->userLogOut();
}

if(!empty($websiteUrl))
{
	$add_http = "";

	if(strpos($websiteUrl,"http://") === false)
	{
		$add_http = "http://";
	}

	header("location: ../index.php");
	die();
}
else
{
 header("Location: login.php");
	die();
}

?>
