<?php
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

