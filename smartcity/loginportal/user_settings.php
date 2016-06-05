<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
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
window.location = "http://m.parkalert.xyz/user_settings.php";
}
});
</script>
</head>

<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<?php require_once("models/top-nav.php"); ?>

<!-- PHP GOES HERE -->
<?php
//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

if(!empty($_POST))
{
  $token = $_POST['csrf'];
if(!Token::check($token)){
  die('Token doesn\'t match!');
}
  $errors = array();
  $successes = array();
  $password = $_POST["password"];
  $password_new = $_POST["passwordc"];
  $password_confirm = $_POST["passwordcheck"];
  $Mobile_Number = $_POST["mobilenumber"];
  $errors = array();
  $email = $_POST["email"];

//PLEASE NOTE: Even though the code uses words like "hash" we are not doing
//standard hashing. The entire codebase has been upgraded to bcrypt. The variables
//have remained the same for backwards compatibility with some UserCake mods.
  //Perform some validation
  //Feel free to edit / change as required

  //Confirm the hashes match before updating a users password
	$entered_pass = password_verify($password,$loggedInUser->hash_pw);

  if (trim($password) == ""){
    $errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
  }
  else if($entered_pass != $loggedInUser->hash_pw)
  {
    //No match
    $errors[] = lang("ACCOUNT_PASSWORD_INVALID");
  }
  if($email != $loggedInUser->email)
  {
    if(trim($email) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_EMAIL");
    }
    else if(!isValidEmail($email))
    {
      $errors[] = lang("ACCOUNT_INVALID_EMAIL");
    }
    else if(emailExists($email))
    {
      $errors[] = lang("ACCOUNT_EMAIL_IN_USE", array($email));
    }

    //End data validation
    if(count($errors) == 0)
    {
      $loggedInUser->updateEmail($email);
      $successes[] = lang("ACCOUNT_EMAIL_UPDATED");
    }
  }
  
    if($Mobile_Number != $loggedInUser->mobilenumber)
  {
    if(trim($Mobile_Number) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_EMAIL");
    }
    else if(mobileExists($Mobile_Number))
    {
      $errors[] = lang("ACCOUNT_MOBILE_IN_USE", array($Mobile_Number));
    }

    //End data validation
    if(count($errors) == 0)
    {
      $loggedInUser->updateMobile($Mobile_Number);
      $successes[] = lang("ACCOUNT_MOBILE_UPDATED");
    }
  }

  if ($password_new != "" OR $password_confirm != "")
  {
    if(trim($password_new) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_NEW_PASSWORD");
    }
    else if(trim($password_confirm) == "")
    {
      $errors[] = lang("ACCOUNT_SPECIFY_CONFIRM_PASSWORD");
    }
    else if(minMaxRange(8,50,$password_new))
    {
      $errors[] = lang("ACCOUNT_NEW_PASSWORD_LENGTH",array(8,50));
    }
    else if($password_new != $password_confirm)
    {
      $errors[] = lang("ACCOUNT_PASS_MISMATCH");
    }

    //End data validation
    if(count($errors) == 0)
    {
      //Also prevent updating if someone attempts to update with the same password
      $entered_pass_new = password_verify($password_new,$loggedInUser->hash_pw);

      if($entered_pass_new == $loggedInUser->hash_pw)
      {
        //Don't update, this fool is trying to update with the same password hahaha
        $errors[] = lang("ACCOUNT_PASSWORD_NOTHING_TO_UPDATE");
      }
      else
      {
        //This function will create the new hash and update the hash_pw property.
        $loggedInUser->updatePassword($password_new);
        $successes[] = lang("ACCOUNT_PASSWORD_UPDATED");
      }
    }
  }
  if(count($errors) == 0 AND count($successes) == 0){
    $errors[] = lang("NOTHING_TO_UPDATE");
  }
}
?>

        <div id="page-wrapper" style="height:100vh; background-image:url(texture.png)">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                  <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <h1 class="page-header" align="center">
                            User Settings
                            <!-- <small>Subheading</small> -->
                        </h1>
<!-- CONTENT GOES HERE -->

<?php
echo resultBlock($errors,$successes);

echo "
<div id='regbox'>
<form name='updateAccount' action='".$_SERVER['PHP_SELF']."' method='post'>
<p>
<label>Password:</label>
<input class='form-control' type='password' name='password' />
</p>
<p>
<label>Email:</label>
<input class='form-control' type='text' name='email' value='".$loggedInUser->email."' />
</p>
<p>
<label>Mobile/Update New Mobile:</label>
<input class='form-control' type='text' name='mobilenumber' value='".$loggedInUser->mobilenumber."' />
</p>
<p>
<label>New Password (8 character minimum):</label>
<input class='form-control' type='password' name='passwordc' />
</p>
<p>
<label>Confirm Password:</label>
<input class='form-control' type='password' name='passwordcheck' />
</p>
";
?>
<input type="hidden" name="csrf" value="<?=Token::generate();?>" >
<?php echo "
<p>
<label>&nbsp;</label>
<input class='btn btn-primary' type='submit' value='Update' class='submit' />
</p>
</form>
";

?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<!-- footer -->
<?php require_once("models/footer.php"); ?>
