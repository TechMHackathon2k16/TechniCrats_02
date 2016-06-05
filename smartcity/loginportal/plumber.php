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
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<?php require_once("models/top-nav.php"); ?>
<body class="container" style="background-color:#F2F2F2 ; height:100vh; font-family: Verdana; background-image:url(texture.png)">
<br/><br/>
<h1 align="center">Plumbers</h1>
<br/>
<br/>
<br/>

			
<?php
		$conn = new mysqli('localhost','root','','userspice');
	
		$r = $conn->query("select * from services where Occupation='Plumber' and Location='$loggedInUser->location'");	
	
		for($i = 0; $i < $r->num_rows; $i++){
			$row = $r->fetch_array(MYSQLI_ASSOC);
			?>
			
<div class="container">
  <div class="row">
  	<div class="col-md-8">
    
      <div class="panel panel-default">
			<div class="panel-body">
              		<div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <h2><?php     echo "".$row["Name"]."" ;    ?></h2>
                            <p><strong>Mobile Number : </strong><?php     echo "".$row["Mobile_Number"]."";    ?> </p>
                            <p><strong>Occupation : </strong> <?php     echo "".$row["Occupation"]. "";    ?> </p>
                            
                        </div>          

                        
                        <div class="col-xs-12 col-sm-4">        
                            <a class="btn btn-info btn-block" href="a.php?number=<?php echo $row["Mobile_Number"]; ?>"><span class="fa fa-user"></span> Send the Request !! </a>
							<a class="btn btn-success btn-block" href="#"> Update Status Of Request </a>
                        </div>
        
              		</div>
              </div>
          </div>

    
    
    </div>
  </div>
</div>
		<?php
		}
		?>

		</div>
		</div>

</body>
</html>
