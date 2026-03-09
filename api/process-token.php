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

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once '../jwt/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secretKey = 'password';

if (isset($_POST['token'])) {
    $token = $_POST['token'];

    try {
        $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

	    $role = $decoded->jwtrole;

        session_start();
	    $_SESSION['jwtrole'] = $role;

        header('Location: ../jwt.php');
        exit();
    } catch (Exception $e) {
        echo 'Invalid token: ' . $e->getMessage();
    }
} else {
    echo 'Token not present in the request.';
}
?>
