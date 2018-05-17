<?php
$host = "localhost";
$username = "root";
$password = "Tu2tlem@tching";
$dbname = "turtle";
$conn = new mysqli($host, $username, $password, $dbname );
mysqli->set_charset('utf8');
mysqli->query("SET collation_connection = utf8_unicode_ci");
?>

