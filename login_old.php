<?php
  session_start();

  include 'includes/config.php';
  include 'includes/functions.php';
  include 'includes/func_mysql.php';
 

  $msg = "";

  // check if have $_POST , query db and return to $msg
  if(count($_POST) > 0) {
    $ntc_user = test_input($_POST["userName"]);
    $ntc_pass = test_input($_POST["password"]);

    $conn = getConnection(db_host, db_user, db_pass, db3);
    $sql = "SELECT idUser, user, pass, fullname FROM users WHERE user='".$ntc_user."' and pass='".$ntc_pass."' limit 1";

    $user = getArray($conn, $sql);
    //$user = getArray_foreach($conn, $sql);
    //$user = getArray_while($conn, $sql);
    //if($user[0][0]!=""){    // dùng điều kiện này bị sai, hàm getarray() nếu ko có query được kết quả sẽ trả về false, dùng if($user) để xét nó có true ko
    if($user) {
      $_SESSION["id"] = $user[0][0];
      $_SESSION["user"] = $user[0][1];
      //$msg = var_dump($user);
    } else {
        $msg = "Invalid Username or Password";
    }
  }

  if(isset($_SESSION['id'])) {

    $conn = getConnection(db_host, db_user, db_pass, db3);
    $sql =  "SELECT navbar_menu.*
            FROM users
            INNER JOIN user_has_navbar ON users.idUser = user_has_navbar.idUser
            INNER JOIN navbar_menu ON user_has_navbar.idNavbar = navbar_menu.idNavbar
            WHERE users.idUser='".$_SESSION['id']."'";  

    $_SESSION['navbar'] = getArray($conn, $sql);
    //var_dump($_SESSION['navbar']);  //test array return
  }

  if (isset($_SESSION["id"])) {
    header("Location:abandon.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Login Details</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/login.css" rel="stylesheet">  

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="js/login/ie-emulation-modes-warning.js"></script>

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="js/login/ie10-viewport-bug-workaround.js"></script>

  <script type="text/javascript">
    function js_validateLogin() {
      var usr = $("#userName").val();
      var pwd = $("#password").val();
      if(usr=='' || pwd=='') {
        alert("Please fill out the form");
      }
    }
  </script>
</head> <!-- end head -->




<body>

  <div class="container">

    <div class="row">
      <div style="height: 100px">
        <?php if($msg!="") { ?>
        <div class="col-md-4 col-md-push-4 alert alert-danger" style="margin-top: 2em">
          <p class="text-center">
            <a style="font-weight: bold; color: red"><?php echo $msg; ?></a>
          </p>
        </div>   
        <?php } ?>
      </div>
    </div>
 
  </div><!-- end .container-fluid -->

  <div class="container">

    <form class="form-signin" role="form" method="post" action="" onsubmit="return js_validateLogin()">
      <h2 class="form-signin-heading">Please sign in</h2>
      <input type="text" class="form-control" id="userName" placeholder="Username" name="userName" required autofocus>
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
      <label class="checkbox">
        <input type="checkbox" value="remember-me"> Remember me
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

  </div> <!-- /container -->



  <script src="jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>