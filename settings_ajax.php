<?php
session_start();
require_once 'includes/db_config.php';
if(!isset($_SESSION['id'])) header('Location: index.php');



if(isset($_POST['submitChangePass'])) {

}



?>