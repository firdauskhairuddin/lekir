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

require_once 'jwt/autoload.php';

use Firebase\JWT\JWT;

// Your secret key for signing the token
$secretKey = 'password';

// User information or any other data you want to include in the token
$userData = [
    'jwtrole' => 'user'
];

// Create a token
$token = JWT::encode($userData, $secretKey, 'HS256');

// Return the token as the response
echo $token;
?>

