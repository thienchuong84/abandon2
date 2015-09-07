<!-- Create August 07, 2015 : used in mjn.php, mjn_abandon.php -->

<nav class="navbar navbar-inverse navbar-static-top">

  <div class="container">

    <div class="navbar-header">
      <a class="brand navbar-brand" href="mjn.php">MJN Project</a>
    </div><!-- end navbar-header -->


    <?php // if isset($_SESSION['navbar']) -> Load navbar for user
    //if(isset($_SESSION['navbar']) && $_SESSION['navbar'][0][0]!="") {
    /* Update Aug 10: sau khi đăng nhập từ trang login.php, nếu đăng nhập thành công sẽ trả về $_SESSION['id'], từ đó query để lấy các giá trị navbar mà user này có được
    Trong login.php $_SESSION['navbar'] = getArray() lầy từ id user, tròng hàm này sẽ trả về array nếu có dữ liệu và trả về false nếu ko có dữ liệu. 
    Vì vậy test thử if($_SESSION['navbar']) thay cho if(isset($_SESSION['navbar'])) , vì $_SESSION['navbar'] vẩn có thể có với biến là false 
      Continue Update: nếu bỏ if(isset($_SESSION['navbar'])) sẽ gây ra lỗi trong trường hợp user chưa đăng nhập, vì vậy ta vẩn để điều kiện này, sau đó mới xét tiếp xem biến này có dữ liệu hay ko bằng cách kiểm tra nó true 
      Next to: cần phải viết function cho navbar, sau khi kiểm tra nếu tồn tại $_SESSION['navbar'] này thì gọi function ra sử dụng */ 
    if(isset($_SESSION['navbar'])) {
      if ($_SESSION['navbar']) { 
        $count = count($_SESSION['navbar']);
        for($i=0; $i<$count; $i++) {  ?>
          <ul class="nav navbar-nav">      
            <!--<li class="active"><a href="mjn_abandon.php">Abandon</a></li>-->
            <li class="active"><a href="<?php echo $_SESSION['navbar'][0][1]; ?>"><?php echo $_SESSION['navbar'][0][2]; ?></a>
          </ul>
    <?php }}} ?>



    <?php // if isset($_SESSION) -> show "Sign in as USER" , else show "Sign in" link to Login page
    if(isset($_SESSION['id'])) {   ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a><?php echo date("l").", ".date("F")." ".date("d").", ".date("Y"); ?></a></li>        
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
    <?php } 
    else { ?>
      <!--<ul class="nav navbar-nav navbar-right">
        <li><a href="login.php" class="btn btn-link" role="button"><span class="glyphicon glyphicon-user" aria-hidden="true"> Login</a></li>
        <li><a><?php echo date("l").", ".date("F")." ".date("d").", ".date("Y"); ?></a></li>
      </ul>-->    
      <ul class="nav navbar-nav navbar-right">        
        <li><a><?php echo date("l").", ".date("F")." ".date("d").", ".date("Y"); ?></a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-user" aria-hidden="true"> Login</a></li>
      </ul>
    <?php } ?>

  </div>

</nav>