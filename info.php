<?php
session_start();
include('./core/configuration.php');
include('./core/function.php');

$session = new Session();
$session->check_invalid_session();

phpinfo();
?>