<head>
<script src='https://www.google.com/recaptcha/api.js'></script>
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
	<script>
$(document).ready(function(){
  if($(window).width() <= 950) {
window.location = "http://m.parkalert.xyz/register.php";
}
});
</script>
</head>
<?php

require_once("models/config.php");

require_once("models/recaptcha.config.php"); //include reCAPTCHA keys

if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<?php require_once("models/top-nav.php"); ?>

<!-- PHP GOES HERE -->
<?php

if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
  $errors = array();
  $email = trim($_POST["email"]);
  $location = trim($_POST["location"]);
  $username = trim($_POST["username"]);
  $displayname = trim($_POST["displayname"]);
  $carnumber = trim($_POST["carnumber"]);
  $mobilenumber = trim($_POST["mobilenumber"]);
  $password = trim($_POST["password"]);
  $confirm_pass = trim($_POST["passwordc"]);

  //reCAPTCHA 2.0 check
	// empty response
	$response = null;

	// check secret key
	$reCaptcha = new ReCaptcha($privatekey);

	// if submitted check response
	if ($_POST["g-recaptcha-response"]) {
	    $response = $reCaptcha->verifyResponse(
	        $_SERVER["REMOTE_ADDR"],
	        $_POST["g-recaptcha-response"]
	    );
	}
	if ($response != null && $response->success) {

  if(minMaxRange(5,25,$username))
  {
    $errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
  }
  if(!ctype_alnum($username)){
    $errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
  }
  if(minMaxRange(5,25,$displayname))
  {
    $errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25));
  }
  	if(minMaxRange(5,15,$carnumber))
	{
		$errors[] = lang("CAR_NUMBER_CHAR_LIMIT",array(5,15));
	}
	if(!ctype_alnum($carnumber)){
		$errors[] = lang("CAR_NUMBER_INVALID_CHARACTERS");
	}
	if(!ctype_digit($mobilenumber))
{
$errors[] = lang("INVALID_MOBILENUMBER");
}
  if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
  {
    $errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
  }
  else if($password != $confirm_pass)
  {
    $errors[] = lang("ACCOUNT_PASS_MISMATCH");
  }
  if(!isValidEmail($email))
  {
    $errors[] = lang("ACCOUNT_INVALID_EMAIL");
  }

  //End data validation
  if(count($errors) == 0)
  {
    //Construct a user object
    $user = new User($username,$displayname,$carnumber,$mobilenumber,$password,$email,$location);

    //Checking this flag tells us whether there were any errors such as possible data duplication occured
    if(!$user->status)
    {
      if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
      if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
      if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));
	  if($user->carnumber_taken) 	  $errors[] = lang("CAR_NUMBER_IN_USE",array($carnumber));
    }
    else
    {
      //Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
      if(!$user->userCakeAddUser())
      {
        if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
        if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
      }
    }
  }
  if(count($errors) == 0) {
    $successes[] = $user->success;
  }
}
}
?>

<div id="page-wrapper" style="background-image:url(texture.png)" class=" fade-in one">

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <h1 class="page-header" align="center">
        Register
      </h1>

      <?php
      echo resultBlock($errors,$successes);

      echo "
      <div id='regbox'>
      <form name='newUser' action='register.php' method='post'>

      <p>
      <label><mark style='font-size:17px'>User Name </mark> (No Spaces or Special Characters - Min 5 characters):</label>
      <input class='form-control' type='text' name='username' />
      </p>
      <p>
      <label><mark style='font-size:17px'>Display Name</mark> (Min 5 characters):</label>
      <input class='form-control' type='text' name='displayname' />
      </p>
	  <p>
	  <label><mark style='font-size:17px'>Car Number </mark>:</label>
      <input class='form-control' type='text' name='carnumber' />
      </p>
	  <p>
	  <label><mark style='font-size:17px'>Mobile Number</mark>:</label>
      <input class='form-control' type='text' name='mobilenumber' />
      </p>
	  <p>
      <label><mark style='font-size:17px'>Password </mark>(Min 8 Characters):</label>
      <input class='form-control' type='password' name='password' />
      </p>
      <p>
      <label><mark style='font-size:17px'>Confirm Password:</mark></label>
      <input class='form-control' type='password' name='passwordc' />
      </p>
      <p>
      <label><mark style='font-size:17px'>Email:</mark></label>
      <input class='form-control' type='text' name='email' />
      </p>
	  <p>
      <label><mark style='font-size:17px'>Location:</mark></label>
      <input class='form-control' type='text' name='location' value='ABES Engineering College' readonly/>
      </p>
      <p>
      <p><label>Please complete the captcha as they appear:</label>"; ?>

      <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>

      <p>
      <label>&nbsp;<br>
      <input class='btn btn-primary' type='submit' value='Register'/>
      </p>

      </form>

      </div>
    </div>
  </div>
</div>

</div>
<!-- footer -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php require_once("models/footer.php"); ?>
