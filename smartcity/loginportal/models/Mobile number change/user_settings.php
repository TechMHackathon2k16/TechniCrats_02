<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<?php require_once("models/top-nav.php"); ?>

<!-- If you are going to include the sidebar, do it here -->

</div>
<!-- /.navbar-collapse -->
</nav>
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

  $errors = array();
  $Mobile_Number = $_POST["Mobile_Number"];

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
  if($Mobile_Number != $loggedInUser->Mobile_Number)
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
        <div id="page-wrapper">


            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                  <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <h1 class="page-header">
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
<label>New Mobile Number:</label>
<input class='form-control' type='text' name='Mobile_Number' />
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
