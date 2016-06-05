<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<?php require_once("models/header.php"); ?>
<div id="wrapper">
<?php require_once("models/top-nav.php"); ?>
</div>
<!-- /.navbar-collapse -->
</nav>
<!-- PHP GOES HERE -->








        <div id="page-wrapper">

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
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
<!-- CONTENT GOES HERE -->


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
