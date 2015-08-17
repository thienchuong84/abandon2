<?php
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