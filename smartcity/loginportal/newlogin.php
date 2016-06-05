<?php

require_once("models/config.php");

require_once("models/recaptcha.config.php"); //include reCAPTCHA keys

if (!securePage($_SERVER['PHP_SELF'])){die();}
?>

<?php

if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$token = $_POST['csrf'];
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}

	$response = null;


	$reCaptcha = new ReCaptcha($privatekey);

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

		//A security note here, never tell the user which credential was incorrect
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
					//Passwords match! we're good to go'

					//Construct a new logged in user object
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
<style media="screen">
@import url(http://fonts.googleapis.com/css?family=Roboto);

/****** LOGIN MODAL ******/
.loginmodal-container {
padding: 30px;
max-width: 350px;
width: 100% !important;
background-color: #F7F7F7;
margin: 0 auto;
border-radius: 2px;
box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
overflow: hidden;
font-family: roboto;
}

.loginmodal-container h1 {
text-align: center;
font-size: 1.8em;
font-family: roboto;
}

.loginmodal-container input[type=submit] {
width: 100%;
display: block;
margin-bottom: 10px;
position: relative;
}

.loginmodal-container input[type=text], input[type=password] {
height: 44px;
font-size: 16px;
width: 100%;
margin-bottom: 10px;
-webkit-appearance: none;
background: #fff;
border: 1px solid #d9d9d9;
border-top: 1px solid #c0c0c0;
/* border-radius: 2px; */
padding: 0 8px;
box-sizing: border-box;
-moz-box-sizing: border-box;
}

.loginmodal-container input[type=text]:hover, input[type=password]:hover {
border: 1px solid #b9b9b9;
border-top: 1px solid #a0a0a0;
-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}

.loginmodal {
text-align: center;
font-size: 14px;
font-family: 'Arial', sans-serif;
font-weight: 700;
height: 36px;
padding: 0 8px;
/* border-radius: 3px; */
/* -webkit-user-select: none;
user-select: none; */
}

.loginmodal-submit {
/* border: 1px solid #3079ed; */
border: 0px;
color: #fff;
text-shadow: 0 1px rgba(0,0,0,0.1);
background-color: #4d90fe;
padding: 17px 0px;
font-family: roboto;
font-size: 14px;
/* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
}

.loginmodal-submit:hover {
/* border: 1px solid #2f5bb7; */
border: 0px;
text-shadow: 0 1px rgba(0,0,0,0.3);
background-color: #357ae8;
/* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
}

.loginmodal-container a {
text-decoration: none;
color: #666;
font-weight: 400;
text-align: center;
display: inline-block;
opacity: 0.6;
transition: opacity ease 0.5s;
}

.login-help{
font-size: 12px;
}
</style>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container">
					<h1>Login to Your Account</h1><br>
				  <form>
					<input type="text" name="user" placeholder="Username">
					<input type="password" name="pass" placeholder="Password">
					<input type="submit" name="login" class="login loginmodal-submit" value="Login">
				  </form>

				  <div class="login-help">
					<a href="#">Register</a> - <a href="#">Forgot Password</a>
				  </div>
				</div>
			</div>
		  </div>
