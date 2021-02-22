<?php
require_once("passwords.php");
$mysqli = mysqli_connect($host, $user, $pass, $db);
if (mysqli_connect_errno($mysqli)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die;
}

$r = $mysqli->query("select * from users");
if (!$r) {
	print "mysql error";
	exit;
}

while ($row = $r->fetch_array()) {
	print_r($row);
}
?>



