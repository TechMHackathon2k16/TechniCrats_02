<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
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

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
$(document).ready(function(){
  if($(window).width() <= 950) {
window.location = "http://m.parkalert.xyz/login.php";
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
</br>
</br>

<?php

if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$token = $_POST['csrf'];
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}
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

	$errors = array();
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);

	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

		if(!usernameExists($username))
		{
		$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{

				$entered_pass = password_verify($password,$userdetails["password"]);


				if($entered_pass != $userdetails["password"])
				{

					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID"); //MAKE UPGRADE CHANGE HERE

				}
				else
				{

					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					$loggedInUser->mobilenumber = $userdetails["Mobile_Number"];
					$loggedInUser->carnumber = $userdetails["Car_Number"];
					$loggedInUser->location = $userdetails["Location"];


					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION["userCakeUser"] = $loggedInUser;

					//Redirect to user account page
					header("Location: account.php");
					die();
				}
			}
		}
	}
}

?>
<body class=" fade-in one" >

        <div id="page-wrapper"  style=" height:100vh; background-image:url(texture.png)">
            <div class="container-fluid">

                <div class="row">
									<div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <h1 class="page-header" align="center">
                          <b style="font-family:Fertigo">  Login </b>
                        </h1>


<?php
echo resultBlock($errors,$successes);
echo "
<div id='regbox'>
<form name='login' action='".$_SERVER['PHP_SELF']."' method='post'>
<p>
";
?>
<label><mark style='font-size:17px'>Username:</mark></label>
<input  class='form-control' type='text' name='username' />
</p>
<p>
<label><mark style='font-size:17px'>Password:</mark></label>
<input  class='form-control'  type='password' name='password' />
</p>
<p><label>Please complete the Captcha as they appear:</label>
	<div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>
</p>
<p>
<label>&nbsp;</label>
<input class='btn btn-primary' type='submit' value='Login' class='submit' />
</p>
<input type="hidden" name="csrf" value="<?=Token::generate();?>" >
</form>
							      </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- footer -->
<?php require_once("models/footer.php"); ?>
</body>