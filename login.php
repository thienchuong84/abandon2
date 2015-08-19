<?php
  session_start();

  require_once 'includes/db_config.php';
  require_once 'includes/sanitize.php';

  include 'includes/functions.php';
  include 'includes/func_mysql.php';
 

  $msg = "";

  // check if have $_POST , query db and return to $msg
  if(isset($_POST['username']) && isset($_POST['password'])) {
    $conn = new mysqli($hn, $un, $pw, $db3);
    if($conn->connect_error) die ($conn->connect_error);

    $un_tmp = mysql_entities_fix_string($conn, $_POST["username"]);
    $pw_tmp = mysql_entities_fix_string($conn, $_POST["password"]);
    
    $sql = "SELECT idUser, user, pass, fullname FROM users WHERE user='$un_tmp'";

    $result = $conn->query($sql);

    if (!$result) die ("Database access failed: " . $conn->error);
    elseif ($result->num_rows) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $result->close();
      $salt1 = "qm&h*";
      $salt2 = "pg!@";
      $token = hash('ripemd128', "$salt1$pw_tmp$salt2");

      if($token == $row['pass']) {
        $_SESSION['id']   = $row['idUser'];
        $_SESSION['user'] = $row['user'];
        $_SESSION['fn']   = $row['fullname'];
        $_SESSION['pass'] = $row['pass'];

        $sql2 =  "SELECT navbar_menu.*
                FROM users
                INNER JOIN user_has_navbar ON users.idUser = user_has_navbar.idUser
                INNER JOIN navbar_menu ON user_has_navbar.idNavbar = navbar_menu.idNavbar
                WHERE users.idUser='".$_SESSION['id']."'";
        $_SESSION['navbar'] = getArrayNum($conn, $sql2);

        $sql3   = "SELECT     navtab_menu.* 
                  FROM        users
                  INNER JOIN  roles_navtab    ON users.idRole = roles_navtab.idRole
                  INNER JOIN  navtab_menu ON roles_navtab.idMenu = navtab_menu.idMenu
                  WHERE       idUser='".$_SESSION['id']."'";
        $_SESSION['navtab'] = getArrayNum($conn, $sql3);          
                   
        header("Location:abandon.php");
        //header("Location:test.php");
      }
      else $msg = "Invaid Password";
    }
    else $msg = "Not exists user '$un_tmp'.";
  }

  if(isset($_SESSION['id'])) header("Location:abandon.php");
  //if(isset($_SESSION['id'])) echo "Welcome " . $_SESSION['fullname'];


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

    <form class="form-signin" role="form" method="post" action="">
      <h2 class="form-signin-heading">Please sign in</h2>
      <input type="text" class="form-control" id="username" placeholder="Username" name="username" required autofocus>
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