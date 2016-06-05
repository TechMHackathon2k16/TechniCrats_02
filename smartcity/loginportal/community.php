<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF']))
{
	die();
	}
	?>

<html lang="en">
<head>

    <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.min.css">
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
                            Send Broadcast Message !!!
							 </h1>
                          </div>
				</div>
			</div>
<br/>


 <form name="sentMessage" id="MessageForm" action="broadcastmessage.php" method="POST" >
									
									
									<br/>

                                        <div class="form-group">
                                            <label>Enter Message</label>
                                            <textarea class="form-control" placeholder="Enter the Message" name="message" id="message" rows="3">
											</textarea>
                                        </div>
                            <div class="form-group" align="center">
                                <button type="submit" class="btn btn-success btn-lg">Send Message</button>
                            </div>
						
          
                            
                                    </form>
</div>


<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.11.1.min.js"></script>



</body>
</html>                               



							  