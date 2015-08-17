<?php
session_start();




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MJN Report</title>
    <script src="jquery/1.11.3/jquery.min.js"></script>
    <link id="bs-css" href="css/bootstrap.min.css" rel="stylesheet">
    <link id="bsdp-css" href="bootstrap-datepicker/css/datepicker3.css" rel="stylesheet">
    <script src="js/mjn_abandon.js"></script>

    <style>
      body {
        padding-top: 50px;
      }
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
    <link href="bootstrap-datepicker/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="bootstrap-datepicker/docs.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="bootstrap-datepicker/google-code-prettify/prettify.min.js"></script>

    <script src="bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="bootstrap-datepicker/js/locales/bootstrap-datepicker.vi.js" charset="UTF-8"></script>

  </head>

  <body>

  

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand navbar-brand" href="#">MJN Project</a>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Abandon</a></li>
            <li><a href="#" taget="_blank"><?php if(isset($_SESSION['user'])){ echo "Welcome ".$_SESSION["user"]; } ?></a></li>
            <!--
            <li><a href="#" taget="_blank">GitHub</a></li>
            -->
          </ul>
        </div>
      </div>
    </div>
  <div class="container-fluid" id="content">
    <div class="row">
      <div class="col-md-1"></div>
      <!-- <div class="col-md-10" style="border: 1px dashed #777"> -->
      <div class="col-md-10">
        <div class="row">
            <h1>Abandon System</h1>           
        </div>
        
        <div class"row">    
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <form class="form-inline" style="margin-top: 50px; margin-bottom: 2em;" method="post" action="#" name="abandon_form" >
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
            </div>

            <script type="text/javascript">
                $(function () {
                    $('#ntc_abandon_date').datepicker();
                });                             
            </script>
        </div>
        <div class="row" id="position_that_show_process"></div>
        <div class="row" id="position_that_you_show"></div>
        
      </div><!-- end .col-md-10 -->
      

      <div class="col-md-1"></div>
    </div>


</body>
</html>
