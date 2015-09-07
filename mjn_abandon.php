<?php
session_start();

if(!isset($_SESSION["id"])) {
	header("Location:login.php");
}

// 28/7 0984399452
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>MJN Report</title>
		<script src="jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>

		<script src="js/mjn_abandon.js"></script>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/datepicker.css" rel="stylesheet">
		<style>
			#content h2 {
                color: #8ac007;
			  color: #7961AA;
        color: #428BCA;
			}
			.selected {
			  border-color: red;
			}
			#position_that_show_process {
				text-align: center;
				color: red;
			}
		</style>
	</head>

	<body>
		
    <!--<nav class="navbar navbar-inverse navbar-static-top">
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="brand navbar-brand" href="#">MJN Project</a>
        </div>

        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Abandon</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expand="false">
              Signed in as <strong><?php echo $_SESSION["user"]; ?></strong> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="mjn_abandon_settings.php">Settings</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    -->
    <?php include 'inc_navbar.php'; ?>

    <div class="container" id="content">
      <div class="row">
        <div class="jumbotron">
          <h2 class="text-center">Abandon Detail</h2><div class="row">
          <!--<p>
            <?php if(isset($_SESSION['navbar'])) {
              var_dump($_SESSION['navbar']);echo "<br />";var_dump($_SESSION['id']);echo "<br />";var_dump($_SESSION['user']);
            } ?>
          </p>-->
        </div>     
      </div>

      <div class="row">
        <div class="panel panel-primary">
          <div class="panel-heading clearfix">
            <div class="panel-title pull-right">
              <form class="form-inline" method="post" action="#" name="abandon_form" >
                <div class="form-group">
                  <label for="abandon_date">Date</label>
                  <input type="text" class="form-control" id='ntc_abandon_date' name="ntc_abandon_date" placeholder="mm/dd/yyyy">              
                </div>
                <div class="form-group">
                  <label for="callerid">CallerID</label>
                  <input type="text" class="form-control" id="ntc_callerid" name="ntc_callerid">
                </div>
                <button type="button" name="submit" class="btn btn-default" id="submit" onclick="ajaxSubmit()">Submit</button>
              </form>
            </div><!-- end .panel-title -->
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4"><strong style="text-decoration: underline;">Abandon detail list:</strong></div>
              <div class="col-md-4" id="position_that_show_process"></div>
              <!-- <div class="col-md-10 col-md-push-1"><div class="row text-center" id="position_that_you_show"></div></div>-->              
            </div><!-- .row2 -->
            <div class="row"><div class="col-md-10 col-md-push-1"><hr style="border: 1px dashed #428BCA" /></div></div>
            <div class="row">
              <div id="position_that_you_show"></div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
          $(function () {
              $('#ntc_abandon_date').datepicker();
          });                             
      </script>


      
      
    </div><!-- end .container // 28/7 0984399452 -->

  </body>
</html>
