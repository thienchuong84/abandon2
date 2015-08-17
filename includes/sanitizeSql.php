<?php
function mysql_entities_fix_string ($conn, $str) {
	return htmlentities(mysql_fix_string($conn, $str));
}

function mysql_fix_string($conn, $str) {
	if(get_magic_quotes_gpc()) $string = stripcslashes($str);
	return $conn->real_escape_string($str);
}

?>