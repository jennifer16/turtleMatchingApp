
<?php
session_start();
unset($_SESSION['fb_access_token']);
$_SESSION['fromSignout'] = true;
header('Location:login.php');
?>

