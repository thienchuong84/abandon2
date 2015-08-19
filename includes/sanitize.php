<?php
function mysql_entities_fix_string ($conn, $str) {
	return htmlentities(mysql_fix_string($conn, $str));
}

function mysql_fix_string($conn, $str) {
	if(get_magic_quotes_gpc()) $string = stripcslashes($str);
	return $conn->real_escape_string($str);
}

function sannitizeString($var) {
	$var	= trim($var);
	$var	= stripslashes($var);
	$var	= strip_tags($var);
	$var	= htmlspecialchars($var);
	return $var;
}

/*
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
*/
?>