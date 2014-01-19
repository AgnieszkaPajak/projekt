<?php
session_start();
include('classes/user.inc');
include('classes/loggeduser.inc');

$message='';
$message .= unserialize($_SESSION['serial'])->wyloguj();
session_start();
$_SESSION['logout']=$message;
header("Location: index.php");
?>
