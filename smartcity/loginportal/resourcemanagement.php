<head>
	    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- leaftree generics -->
    <link rel="stylesheet" href="css/generics.css">
    <!-- Pixeden Icon Font -->
    <link rel="stylesheet" href="css/iconfont.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
	<title>ParkAlert</title>

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

<h4>
<p>
      <div class="main-content container">
        <div class="row">
		          
          <div class="col-md-4 col-sm-10 margin-bottom-30">
            <div class="position-relative">
              <a href="electrician.php">
                <img class="center-block img-circle img-responsive" src="img/electrician.jpg" alt="portfolio"><h2 align="center"><strong>Electrician</strong></h2>
              </a>
            </div>
          </div>
          <div class="col-md-4 col-sm-10 margin-bottom-30">
            <div class="position-relative">
              <a href="plumber.php">
                <img class="center-block img-circle img-responsive" src="img/plumber.jpg" alt="portfolio"><h2 align="center"><strong>Plumber</strong></h2>
              </a>
            </div>
          </div>
		            <div class="col-md-4 col-sm-10 margin-bottom-30">
            <div class="position-relative">
              <a href="#">
                <img class="center-block img-circle img-responsive" src="img/cook.jpg" alt="portfolio"><h2 align="center"><strong>Cook</strong></h2>
              </a>
            </div>
          </div>
		  
          </div>
          </div>
         <br/>
         <br/>
</p>
</h4>

            </div>
		</body>
		
<!-- footer -->
<?php require_once("models/footer.php"); ?>