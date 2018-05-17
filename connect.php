<?php
$host = "localhost";
$username = "root";
$password = "Tu2tlem@tching";
$dbname = "turtle";
$conn = mysqli_connect($host, $username, $password, $dbname );
mysqli_set_charset('utf8');
mysqli_query("SET collation_connection = utf8_unicode_ci");
?>

