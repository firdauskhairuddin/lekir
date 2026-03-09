<?php
// Determine the base path based on current directory depth
$current_path = $_SERVER['PHP_SELF'];
$base_path = './';
if (strpos($current_path, '/vulnerabilities/') !== false) {
    $parts = explode('/vulnerabilities/', $current_path);
    if (isset($parts[1]) && strpos($parts[1], '/') !== false) {
        $base_path = '../../';
    } else {
        $base_path = '../';
    }
} elseif (strpos($current_path, '/tools/') !== false || strpos($current_path, '/compare/') !== false || strpos($current_path, '/components/') !== false) {
    $base_path = '../';
}


$DB_HOST = '127.0.0.1';
$DB_NAME = "lekir";
$DB_USER = "root";
$DB_PASS = "password";

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

//initiate PDO connection
$connect = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;", $DB_USER, $DB_PASS);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ( mysqli_connect_errno() )
{
	printf( "Connect failed: %s\n", mysqli_connect_error() );
	
	exit();
}

$random_value=md5(uniqid(mt_rand(), true));
$key = "password";
$title = "LEKIR";

?>
