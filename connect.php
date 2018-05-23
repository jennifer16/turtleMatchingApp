<?php
$host = "localhost";
$username = "root";
$password = "Tu2tlem@tching";
$dbname = "turtle";
$conn = new mysqli($host, $username, $password, $dbname );
mysqli_set_charset($conn,'utf8');

define('TIMEZONE', 'Asia/Bangkok');
date_default_timezone_set(TIMEZONE);

mysqli_query($conn, "SET time_zone='+7:00';")
?>

