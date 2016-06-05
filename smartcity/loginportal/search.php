<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF']))
{
	die();
	}
	?>

<?php
file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Handler.php') ? require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Handler.php' : die('There is no such a file: Handler.php');
file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Config.php') ? require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Config.php' : die('There is no such a file: Config.php');

use AjaxLiveSearch\core\Config;
use AjaxLiveSearch\core\Handler;

if (session_id() == '') {
    session_start();
}

    Handler::getJavascriptAntiBot();
    $token = Handler::getToken();
    $time = time();
    $maxInputLength = Config::getConfig('maxInputLength');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
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


    <!-- Live Search Styles -->
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">
    <!--[if IE 7]>
    <link rel="stylesheet" href="css/fontello-ie7.css">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.min.css">
	<script>
$(document).ready(function(){
  if($(window).width() <= 950) {
window.location = "http://m.parkalert.xyz/search.php";
}
});
</script>
</head>
<body>
<div>
	<?php
 if(isUserLoggedIn())
{
 require_once("models/top-nav.php");
} ?>
</div>

 <div id="page-wrapper" style="height: 100vh; position:relative; margin-top:-35px;">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" align="center">
						<br/>
                            Search The Car!!!!
							 </h1>
                          </div>
				</div>
			</div>
<br/>

<div>
<!-- Search Form Demo -->
<form action="abc.php" method="POST">
    <input type="text"  class="mySearch" id="ls_query"/>
    <input type="hidden" name="search" id ="search"/>
	<br/>
	<br/>
	<br/>
	<br/>
	<p align="center">
<input type="submit" id="Submit_Post" class="btn btn-info btn-lg" value="Send The Message!!" />
</p>
</form>
  </div>
<!-- /Search Form Demo -->

</div>
<!-- /Search Form Demo -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.11.1.min.js"></script>

<!-- Live Search Script -->
<script type="text/javascript" src="js/ajaxlivesearch.js"></script>

<script>
jQuery(document).ready(function(){
	jQuery(".mySearch").ajaxlivesearch({
        loaded_at: <?php echo $time; ?>,
        token: <?php echo "'" . $token . "'"; ?>,
        maxInput: <?php echo $maxInputLength; ?>,
        onResultClick: function(e, data) {
            // get the index 1 (second column) value
            var selectedOne = jQuery(data.selected).find('td').eq('1').text();

            // set the input value
            jQuery('.mySearch').val(selectedOne);
			jQuery("#search").val(selectedOne);

            // hide the result
            jQuery(".mySearch").trigger('ajaxlivesearch:hide_result');
           
        },
        onResultEnter: function(e, data) {
            // do whatever you want
            // jQuery(".mySearch").trigger('ajaxlivesearch:search', {query: 'test'});
        },
        onAjaxComplete: function(e, data) {

        }
    });
})
</script>
<script>
$('#orderform').submit(function() {
    if($('#ls_query').val() == ''){
        alert('Please fill out your initials.');
        return false;
    }
});
</script>


</body>
</html>