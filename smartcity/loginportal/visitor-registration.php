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
	
<form name="sentMessage" class="form-horizontal" id="contactForm" >
  <fieldset>
    <div id="legend">
      <h1 align="center"> Visitor Registration</h1>

	  <br/>
	  <br/>
    </div>
    <div class="row control-group">
      <label class="control-label"  for="Name">Name</label>
      <div class="controls">
        <input type="text" id="name" name="name" placeholder="Enter Visitor's Name" class="input-xlarge name" onkeyup="javascript:this.value=this.value.toUpperCase()">
      </div>
    </div>
	
	    <div class="row control-group">
      <label class="control-label"  for="address">From Where</label>
      <div class="controls">
        <input type="text" id="address" name="address" placeholder="Enter Your Address" class="input-xlarge name" onkeyup="javascript:this.value=this.value.toUpperCase()">
      </div>
    </div>
	
	  <div class="row control-group">
	  
      <label class="control-label"  for="mobilenumber">Mobile Number</label>
      <div class="controls">
        <input type="text" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" class="input-xlarge name">
      </div>
    </div>
	
	  <div class="row control-group">
	  
      <label class="control-label"  for="carnumber">Car Number</label>
      <div class="controls">
        <input type="text" id="carnumber" name="carnumber" placeholder="Car Number" class="input-xlarge name" onkeyup="javascript:this.value=this.value.toUpperCase()">
      </div>
    </div>
 
  <div class="row control-group">
      <label class="control-label"  for="flatnumber">Visiting Flat Number</label>
      <div class="controls">
        <input type="text" id="flatnumber" name="flatnumber" placeholder="Purpose of Meeting" class="input-xlarge name" onkeyup="javascript:this.value=this.value.toUpperCase()">
      </div>
    </div>
	
    <div class="row control-group">
      <label class="control-label" for="purpose">Purpose</label>
      <div class="controls">
        <select id="purpose" name="purpose" class="input-xlarge product-type">
            <option value="0">-Select-</option>
            <option value="Personal">Personal</option>
            <option value="Delievery">Delievery</option>
        </select>
      </div>
    </div>

    <div class="row control-group">
      <label class="control-label"  for="frequentvisitor">Frequent Visitor</label>
      <div class="controls">
        <input type="radio" id="frequentvisitor" name="frequentvisitor" value="No" class="input-xlarge published"><span>No</span>
        <input type="radio" id="frequentvisitor" name="frequentvisitor" value="Yes" class="input-xlarge published"><span>Yes</span>
      </div>
    </div>
	<div id="success"></div>
    <div class="row control-group">
      <div class="controls">
        <button type="submit" class="btn btn-success btn-lg">Register</button>
      </div>
    </div>
  </fieldset>
</form>

    <script src="visitorregistration/jqBootstrapValidation.js"></script>
    <script src="visitorregistration/visitor.js"></script>
</div>
</div>
</div>
</body>

