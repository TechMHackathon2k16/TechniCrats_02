<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
	<style>
{
	.dropdown-menu {width: 205px;}
.btn{width: 100%;}
.navbar-default {
	
    
}

}
</style>

  <title>ParkAlert</title>

    <!-- Bootstrap Core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./css/sb-admin.css" rel="stylesheet">
	

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
             
<script src="./js/jquery.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script>
   $(function(){
      $(".dropdown-toggle").dropdown();
   }); 
</script>

</head>

<body>


        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #2C3E50; border-color: #1C1C1C; height:auto ; padding:7px;" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
			

<!-- This is the hamburger menu. You may want to use it! -->
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> 
   <a class="navbar-brand" href="../index.php" style='color:white'><b style="font-size:40px">ParkAlert</b></a>
   
            </div>
            <!-- Top Menu Items -->
			<div class = "collapse navbar-collapse" id = "bs-example-navbar-collapse-1">
 <ul class="nav navbar-nav navbar-right">

										<?php if(isUserLoggedIn()) { echo"
										<li class='dropdown'><a href='account.php' style='color:white' class='btn btn-primary'>Account Info</a></li>
										<li class='dropdown'><a href='search.php' style='color: white' class='btn btn-warning'>Search The Car!!</a></li>
										<li class='dropdown'><a href='logout.php' style='color: white' class='btn btn-danger'>Log Out</a></li>
										";
										if ($loggedInUser->checkPermission(array(3))){
											echo "<li class='dropdown'><a href='residentusers.php' style='color: white' class='btn btn-success'>Residents of society</a></li>";
										}
										
										
										}else {
			              echo"<p> <li class='dropdown'><a href='login.php' style='color:white' class='btn btn-success'><b>LogIn</b></a> </li>    <li class='dropdown'><a href='register.php' style='color:white' class='btn btn-danger'>Register</a></p></li> ";}
										?>

<li class="dropdown">
                    <a href="#" class="dropdown-toggle" style='color:white' data-toggle="dropdown"><i class="fa fa-user"></i> <?php 				//Links for logged in user
				if(isUserLoggedIn()) {
					echo "$loggedInUser->displayname";
				}
				//Links for users not logged in
				else {
					echo "Account";
				} ?>  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <?php

                      //Links for logged in user
                      if(isUserLoggedIn()) {
                      ?>

                              <li>
                                  <a href='account.php'><i class='fa fa-fw fa-dashboard'></i> Account Home</a>
                              </li>
                              <li>
                                  <a href='user_settings.php'><i class='fa fa-fw fa-pencil-square-o'></i> User Settings</a>
                              </li>
							  
                              <!-- <li>
                                  <a href='logout.php'><i class='fa fa-fw fa-angellist'></i> Logout</a>
                              </li> -->


                      <?php
                      	//Links for permission level 2 (default admin)
                      	if ($loggedInUser->checkPermission(array(2))){
                      ?>

                              <li>
                                  <a href='admin_configuration.php'><i class='fa fa-fw fa-wrench'></i> Admin Configuration</a>
                              </li>
                              <li>
                                  <a href='admin_users.php'><i class='fa fa-fw fa-users'></i> Admin Users</a>
                              </li>
                              <li>
                                  <a href='admin_permissions.php'><i class='fa fa-fw fa-code'></i> Admin Permissions</a>
                              </li>
                              <li>
                                  <a href='admin_pages.php'><i class='fa fa-fw fa-newspaper-o'></i> Admin Pages</a>
                              </li>
                              <?php
                              	}
								
									//Links for permission level 3 ( Society Guard)
                      	if ($loggedInUser->checkPermission(array(3))){
                      ?>

                              <li>
                                  <a href='residentusers.php'><i class='fa fa-fw fa-users'></i> Resident Users</a>
								  <a href='visitor_users.php'><i class='fa fa-fw fa-users'></i> Daily Visitors</a>
								  <a href='service_users.php'><i class='fa fa-fw fa-users'></i> Service Providers</a>
                                  <a href='visitor-registration.php'><i class='fa fa-fw fa-users'></i> Visitor's Registration</a>
                                  <a href='service-registration.php'><i class='fa fa-fw fa-users'></i> Service Registration</a>
                                  
                              </li>
                              <?php
                              	}
								
                      }
                              //Links for users not logged in
                              else {
                              ?>

                              <li>
                                  <a href='login.php'><i class='fa fa-fw fa-wrench'></i> Login</a>
                              </li>
                              <li>
                                  <a href='register.php'><i class='fa fa-fw fa-desktop'></i> Register</a>
                              </li>
                              <li>
                                  <a href='forgot-password.php'><i class='fa fa-fw fa-wrench'></i> Forgot Password</a>
                              </li>
                          <?php
                        	if ($emailActivation)
                        	{
                        	echo "
                          <li class='divider'></li>
                          <li><a href='resend-activation.php'>Resend Activation Email</a></li>";
                        	}?>
                        </ul>
							<?php
                        }

                        ?>
						</li>

              
                    </ul>
                </div>
				</nav>
       
