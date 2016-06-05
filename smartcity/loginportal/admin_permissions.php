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
</head>
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
//Forms posted
if(!empty($_POST))
{
  $token = $_POST['csrf'];
if(!Token::check($token)){
  die('Token doesn\'t match!');
}
  //Delete permission levels
  if(!empty($_POST['delete'])){
    $deletions = $_POST['delete'];
    if ($deletion_count = deletePermission($deletions)){
      $successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
    }
  }

  //Create new permission level
  if(!empty($_POST['newPermission'])) {
    $permission = trim($_POST['newPermission']);

    //Validate request
    if (permissionNameExists($permission)){
      $errors[] = lang("PERMISSION_NAME_IN_USE", array($permission));
    }
    elseif (minMaxRange(1, 50, $permission)){
      $errors[] = lang("PERMISSION_CHAR_LIMIT", array(1, 50));
    }
    else{
      if (createPermission($permission)) {
        $successes[] = lang("PERMISSION_CREATION_SUCCESSFUL", array($permission));
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
  }
}

$permissionData = fetchAllPermissions(); //Retrieve list of all permission levels
?>







<div id="page-wrapper" style="height:100vh; background-image:url(texture.png)"">
  <!-- Main jumbotron for a primary marketing message or call to action -->

  <!-- <div class="jumbotron">
  <div class="container">
  <h1>Jumbotron!!!</h1>
  <p>This is a great area to highlight something.</p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
</div>
</div> -->

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <h1 >
        Admin Permissions
      </h1>
      <!-- CONTENT GOES HERE -->

      <?php

      echo resultBlock($errors,$successes);

      echo "
      <form name='adminPermissions' action='".$_SERVER['PHP_SELF']."' method='post'>
      <table class='table table-hover'>
      <tr>
      <th>Delete</th><th>Permission Name</th>
      </tr>";

      //List each permission level
      foreach ($permissionData as $v1) {
        echo "
        <tr>
        <td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
        <td><a href='admin_permission.php?id=".$v1['id']."'>".$v1['name']."</a></td>
        </tr>";
      }

      echo "
      </table>
      <p>
      <label>Permission Name:</label>
      <input type='text' name='newPermission' />
      </p>
      ";
?>
<input type="hidden" name="csrf" value="<?=Token::generate();?>" >
<?php echo "
      <input class='btn btn-primary' type='submit' name='Submit' value='Submit' />
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
