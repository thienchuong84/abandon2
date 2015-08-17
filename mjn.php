<?php
session_start();



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MJN</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
    #show_content b {
      color: red;
    }
  </style>
  
</head>
<body>

  <?php // navbar 
    include 'include_navbar.php';
  ?>  





  <div class="container">
    <div class="row">
    

      <div class="col-md-3">
        <!-- Khai báo 1 panel primary bao bọc list group cho đẹp -->
        <div class="panel panel-primary">
          <div class="panel-heading">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Support
          </div>
          <div class="panel-body">
            <div class="list-group">
              <a href="#" class="list-group-item" id="btn_3"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Contact</a> 
              <a href="#" class="list-group-item" id="btn_1"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Tạo ổ đĩa share mj</a>
              <a href="#" class="list-group-item" id="btn_2"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Mở Gõ Tiếng Việt (xvnkb)</a>              
            </div>           
          </div>
        </div>
      </div>
    

      <div class="col-md-9"> 
        <div id="show_content"><?php include 'mjn_contact.html'; ?></div>
      </div><!-- end div col-md-10 -->


    </div>
  </div><!-- end .container-fluid -->
















  <script src="jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery_load.js"></script>
</body>
</html>