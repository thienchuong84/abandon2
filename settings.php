<?php
session_start();

if(!isset($_SESSION["id"])) {
	header("Location:login.php");
}

include 'includes/config.php';
include 'includes/functions.php';
include 'includes/func_mysql.php';

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
			#content h1 {
			  color: #7961AA;
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


    <?php include 'include_navbar.php'; ?>

    <div class="container" id="content">
    	<div class="row">
      		<div class="col-md-10 col-md-offset-1">
		        <ul class="nav nav-tabs" role="tablist">
		          <li role="presentation" class="active"><a href="#nav_changePass" aria-control="nav_changePass" role="tab" data-toggle="tab">Change Password</a></li>      
		          <?php 
		            if(isset($_SESSION['navtab'])) { 
		              	foreach ($_SESSION['navtab'] as $section => $items) { 
		                	echo <<<_END
		                  	<li role="presentation"><a href="#$items[3]" aria-control="$items[3]" role="tab" data-toggle="tab">$items[4]</a></li>
_END;
		                }
		            }?>
		        </ul>
		        <div class="tab-content">
		          	<div role="tabpanel" class="tab-pane fade in active" id="nav_changePass"><?php include 'settings_changePass.php'; ?></div>
		          	<?php
		           		if(isset($_SESSION['navtab'])) { 
		              		foreach ($_SESSION['navtab'] as $section => $items) {
		                		echo <<<_END
		                  		<div role="tabpanel" class="tab-pane fade" id="$items[3]" role="tab" data-toggle="tab">$items[2]></div>
_END;
              			}
            		}?>            
        			</div>
      			</div>
    		</div>
    	</div>
    </div><!-- end .container -->

  </body>
</html>