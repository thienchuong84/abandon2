<?php
session_start();
unset($_SESSION["id"],$_SESSION["user"],$_SESSION['navbar']);
//header("Location:login.php")
header('Location:mjn.php')

?>