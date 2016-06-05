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

    <link href="service-provider-registration/bootstrap-combined.min.css" rel="stylesheet">
    <script src="service-provider-registration/jquery-1.11.1.min.js"></script>
    <script src="service-provider-registration/bootstrap.min.js"></script>
	<title>ParkAlert</title>
</head>
<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<?php require_once("models/top-nav.php"); ?>
<body id="page-wrapper" style="height:100vh">

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">

<form name="sentMessage" class="form-horizontal" id="contactForm">
  <fieldset>
    <div id="legend" align="center">
	
      <h1 class="controls">Service Provider's Registration</h1>
    </div>
	<hr/>
	<br/>
	<br/>
    <div class="row control-group">
      <label class="control-label"  for="name">Name</label>
      <div class="controls">
        <input type="text" id="name" name="name" placeholder="Name" class="input-xlarge name" onkeyup="javascript:this.value=this.value.toUpperCase()">
      </div>
    </div>
	
	<div class="row control-group">
      <label class="control-label" for="mobile_number">Mobile Number</label>
      <div class="controls">
        <input type="text" id="mobile_number" name="mobile_number" placeholder="Mobile Number" class="input-xlarge sku">
      </div>
    </div>
 
    <div class="row control-group">
      <label class="control-label" for="occupation">Occupation</label>
      <div class="controls">
        <select id="occupation" name="occupation" class="input-xlarge product-type">
            <option value="0">-Choose Occupation-</option>
            <option value="Plumber">Plumber</option>
            <option value="Electrician">Electrician</option>
        </select>
      </div>
    </div>
 
        <div class="row control-group">
      <label class="control-label" for="locations">Location</label>
      <div class="controls">
        <select id="locations" name="locations" class="input-xlarge product-type">
            <option value="0">-Choose Location-</option>
            <option value="abes engineering College">ABES Engineering College</option>
            <option value="gaur homes">Gaur Homes</option>
        </select>
      </div>
    </div>
     
	<div id="success"></div>
	<div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-success btn-lg">Register</button>
      </div>
    </div>
	
  </fieldset>
</form>
   <script  src="service-provider-registration/jqBootstrapValidation.js"></script>
    <script src="service-provider-registration/contact_me.js"></script> 
	</div>
	</div>
	</div>
</body>


