<?php

$hn		= '192.168.100.35';
$un		= 'remote_test';
$pw		= 'dientu@%123456';
$db3	= 'code';


function getArrayNum($conn, $sql) {
	$result = $conn->query($sql);
	if(!$result) die ("Querry Failed : " . $conn->error);	// kiểm tra coi thực hiện query được hay ko
	elseif ($result->num_rows) {		// kiểm tra xem có row nào trả về ko
		$tmp_array = array();
		while($row = $result->fetch_array(MYSQLI_NUM)) {		// có thể tìm hiểu thêm về data_seek và fetch_row để lấy 1 hàng chỉ định, fetch_assoc
			$tmp_array[] = $row;
		}
		return $tmp_array;
	}
	else NULL;

	$result->close();
}

function getArrayAssoc($conn, $sql) {
	$result = $conn->query($sql);
	if(!$result) die ($conn->error);	// kiểm tra coi thực hiện query được hay ko
	elseif ($result->num_rows) {		// kiểm tra xem có row nào trả về ko
		$tmp_array = array();
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {		// có thể tìm hiểu thêm về data_seek và fetch_row để lấy 1 hàng chỉ định, fetch_assoc
			$tmp_array[] = $row;
		}
		return $tmp_array;
	}
	else NULL;

	$result->close();
}



?>