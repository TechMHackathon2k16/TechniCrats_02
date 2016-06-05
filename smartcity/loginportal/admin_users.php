<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">    
    <meta name="author" content="DIVYANSH">
	<meta name="copyright" content="www.parkalert.xyz">
	<meta name="host" 	   content="www.parkalert.xyz">
	
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
</head>
<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<?php require_once("models/top-nav.php"); ?>

<?php
//Forms posted
if(!empty($_POST))
{
  $token = $_POST['csrf'];
if(!Token::check($token)){
  die('Token doesn\'t match!');
}
  $deletions = $_POST['delete'];
  if ($deletion_count = deleteUsers($deletions)){
    $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
  }
  else {
    $errors[] = lang("SQL_ERROR");
  }
}

//Retrieve information for all users according to the current user location
			/*	function fetchAllUsersLocation()
				{
					global $mysqli,$db_table_prefix;
					$stmt = $mysqli->prepare("SELECT
						id,
						user_name,
						display_name,
						Car_Number,
						Mobile_Number,
						password,
						email,
						Location,
						activation_token,
						last_activation_request,
						lost_password_request,
						active,
						title,
						sign_up_stamp,
						last_sign_in_stamp
						FROM ".$db_table_prefix."users WHERE Location='$userlocation'");
						$stmt->execute();
						$stmt->bind_result($id, $user, $display, $carnumber, $mobilenumber, $password, $email, $location, $token, $activationRequest, $passwordRequest, $active, $title, $signUp, $signIn);

						while ($stmt->fetch()){
							$row[] = array('id' => $id, 'user_name' => $user, 'display_name' => $display, 'Car_Number' => $carnumber, 'Mobile_Number' => $mobilenumber, 'password' => $password, 'email' => $email, 'Location' => $location, 'activation_token' => $token, 'last_activation_request' => $activationRequest, 'lost_password_request' => $passwordRequest, 'active' => $active, 'title' => $title, 'sign_up_stamp' => $signUp, 'last_sign_in_stamp' => $signIn);
						}
						$stmt->close();
						return ($row);
					}
					
					*/
$userData = fetchAllUsers(); //Fetch information for all users


?>
<body id="page-wrapper" style="height:100vh; background-image:url(texture.png)">

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 >
        Admin Users 		
		
      </h1>
      <!-- CONTENT GOES HERE -->

      <?php
      echo resultBlock($errors,$successes);

      echo "
      <form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
      <table class='table table-hover'>
      ";
      ?>
  <input type="hidden" name="csrf" value="<?=Token::generate();?>" >
  <?php echo "
      <tr>
      <th>Delete</th><th>Username</th><th>Display Name</th><th>Car Number</th><th>Mobile Number</th><th>Last Sign In</th>
      </tr>";

      //Cycle through users
      foreach ($userData as $v1) {
        echo "
        <tr>
        <td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
        <td><a href='admin_user.php?id=".$v1['id']."'>".$v1['user_name']."</a></td>
        <td>".$v1['display_name']."</td>
        <td>".$v1['Car_Number']."</td>
        <td>".$v1['Mobile_Number']."</td>
        <td>
        ";

        //Interprety last login
        if ($v1['last_sign_in_stamp'] == '0'){
          echo "Never";
        }
        else {
          echo date("j M, Y", $v1['last_sign_in_stamp']);
        }
        echo "
        </td>
        </tr>";
      }

      echo "
      </table>
      <input class='btn btn-primary' type='submit' name='Submit' value='Delete' />
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
</body>
<!-- /#wrapper -->
<!-- footer -->
<?php require_once("models/footer.php"); ?>
