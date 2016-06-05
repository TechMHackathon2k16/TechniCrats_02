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
	    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- leaftree generics -->
    <link rel="stylesheet" href="css/generics.css">
    <!-- Pixeden Icon Font -->
    <link rel="stylesheet" href="css/iconfont.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
	<title>ParkAlert</title>
	<script>
$(document).ready(function(){
  if($(window).width() <= 950) {
window.location = "http://m.parkalert.xyz/account.php";
}
});
</script>
</head>
<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>

<?php 
require_once("models/top-nav.php"); 
?>

	<body id="page-wrapper" style="background-color:#F2F2F2 ; height:100vh; font-family: Verdana; background-image:url(texture.png)">
	<div>
 <div class="container">          
		  <div class="jumbotron">
         
          <h1>Welcome <?php
 echo "
$loggedInUser->displayname <br/>"; ?></h1>
<h3>
<?php
 echo " Your Registered Car Number is :-
$loggedInUser->carnumber <br/><br/>";
 echo "Your Registered Mobile Number is :-
$loggedInUser->mobilenumber <br/><br/>";
 echo "Current Location :-
$loggedInUser->location ";


 ?>
 </h3>
 </div>
       <!--  <p><?php
 echo "
  Are you facing the problem to park your Car . Dont wait anymore . Click the button below to solve all the problems"
 ?></p>
          <p align="center"><a class="btn btn-warning btn-lg" href="search.php" role="button">Search The Car!!!! &raquo;</a></p>
          </div>
          </div> 
-->

<!-- CONTENT GOES HERE -->
<h4>
<p>
      <div class="main-content container">
        <div class="row">
		
          <div class="col-md-4 col-sm-10 margin-bottom-30">
            <div class="position-relative">
              <a href="search.php">
                <img class="center-block img-circle img-responsive" src="img/parkalert.jpg" alt="portfolio"><h2 align="center"><strong>ParkAlert</strong></h2>
              </a>
            </div>
          </div>
          
          <div class="col-md-4 col-sm-10 margin-bottom-30">
            <div class="position-relative">
              <a href="resourcemanagement.php">
                <img class="center-block img-circle img-responsive" src="img/resources.jpg" alt="portfolio"><h2 align="center"><strong>Resources Management</strong></h2>
              </a>
            </div>
          </div>
		            <div class="col-md-4 col-sm-10 margin-bottom-30">
            <div class="position-relative">
              <a href="community.php">
                <img class="center-block img-circle img-responsive" src="img/community.jpg" alt="portfolio"><h2 align="center"><strong>Community Engagement</strong></h2>
              </a>
            </div>
          </div>
          </div>
          </div>
         <br/>
         <br/>



<?php
 echo "
 
 Just so you know, your title at the moment is $loggedInUser->title, You registered this account on " . date("M d, Y", $loggedInUser->signupTimeStamp()) . ".
 ";
?></p>
</h4>

            </div>
		</body>
		
<!-- footer -->
<?php require_once("models/footer.php"); ?>