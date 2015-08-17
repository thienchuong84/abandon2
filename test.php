<?php
session_start();
require_once 'includes/db_config.php';

if(isset($_SESSION['navbar'])) {
	/*
	$products = $_SESSION['navbar'];
	foreach ($products as $section => $items) {
		foreach ($items as $key => $value) {
			echo $key . "  " .$value ."<br>";
		}
	}
	*/
	//print_r($_SESSION['navbar']);
}
//else echo "Ko co session navbar";




$conn = new mysqli($hn, $un, $pw, $db3);
if($conn->connect_error) die ($conn->connect_error);

$sql2 =  "SELECT navbar_menu.*
        FROM users
        INNER JOIN user_has_navbar ON users.idUser = user_has_navbar.idUser
        INNER JOIN navbar_menu ON user_has_navbar.idNavbar = navbar_menu.idNavbar
        WHERE users.idUser='4'";

$var = getArrayNum($conn, $sql2);

if(isset($var)) echo "IF : var has exists.<br>";
else echo "ELSE : var has not exists.<br>";

if(is_null($var)) echo "IF : var is null.";
else echo "ELSE : var not null.";




//echo "sql2 : $sql2";

/*
$result2 = $conn->query($sql2);
if(!$result2) die ("Loi query " . $conn->error);  // kiểm tra coi thực hiện query được hay ko
elseif ($result2->num_rows) {    // kiểm tra xem có row nào trả về ko
	//$_SESSION['navbar'] = array();
	$tmp_array = array();
	//while($row = $result2->fetch_array(MYSQLI_ASSOC)) {    // có thể tìm hiểu thêm về data_seek và fetch_row để lấy 1 hàng chỉ định, fetch_assoc
	
	while($row = $result2->fetch_row()) {
		$tmp_array[] = $row;
	}
	
	$rows = $result2->num_rows;

	for($j=0; $j<$rows; ++$j){
		$result2->data_seek($j);
		//$row = $result2->fetch_array(MYSQLI_ASSOC);echo $row['href'];
		$tmp_array[] = $result2->fetch_array(MYSQLI_ASSOC);
	}
	//echo "Have " . $result2->num_rows . " rows.<br><br>";

	/*
	foreach ($tmp_array as $section => $items) {
		echo $section." ".$items['href']."<br>";
		foreach ($items as $key => $value) {
			echo $value;
		}
	}
	
}
$result2->close();  
*/





?>