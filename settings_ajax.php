<?php
session_start();
require_once 'includes/db_config.php';
require_once 'includes/sanitize.php';
require_once 'includes/functions.php';

if(!isset($_SESSION['id'])) header('Location: index.php');


/*
if(isset($_POST['submitChangePass'])) {
	$token = hashPass($_POST['curPass']);

	if($_SESSION['pass'] == $token) {
		// update password
		$conn = new mysqli($hb, $un, $pw, $db3);
		if(!$conn->connect_error) {
			$msg = "<label>Not connect DB to update Pass : ".$conn->connect_error."</label>";
		} else {
			$tmpNewPass = mysql_entities_fix_string($conn, $_POST['newPass']);
			$sql 		= "UPDATE users SET pass=$tmpNewPass where idUser='".$_SESSION['id']."'";
			$result		= $conn->query($sql);
			if(!$result) $msg = "Not update password : ".$conn->query;
			else $msg = "Updated New Password Successful";
		}
	} else $msg = "<label>Current Password Not Match</label>";

	return $msg;
}
*/
if(isset($_POST['submitChangePass'])) {
	$token = hashPass($_POST['curPass']);

	/* TEST
	echo "token : ".$token."<br>";
	echo "current pass : ".$_SESSION['pass']."<br>";
	echo "current id user : ".$_SESSION['id']."<br>";
	TEST */

	if($_SESSION['pass'] == $token) {
		// update password
		$conn = new mysqli($hn, $un, $pw, $db3);
		if($conn->connect_error) die ("Not connect DB to update Pass : ".$conn->connect_error);

		//$tmpNewPass = mysql_entities_fix_string($conn, $_POST['newPass']);
		$tmpNewPass = hashPass($_POST['newPass']);

		$sql 		= "UPDATE users SET pass='".$tmpNewPass."' where idUser='".$_SESSION['id']."'";
		$result		= $conn->query($sql);

		if(!$result) die ("Not update password : ".$conn->query);
		else echo "Updated New Password Successful";
	} else echo "Current Password Not Match";
}
?>