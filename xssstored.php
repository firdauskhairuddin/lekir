<?php
session_start();
include('./core/configuration.php');
include('./core/function.php');

$session = new Session();
$session->check_invalid_session();
$level = new Level();

$level->check_level($_SESSION['level'],$_SERVER['REQUEST_URI']);
?>