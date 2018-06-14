<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
}

  
  $matchX = $_POST['matchX'];
  $matchY = $_POST['matchY'];
  $matchSide = $_POST['matchSide'];
  $matchId = $_POST['matchId'];

  $filename = "".$matchId."_match";

  $result = shell_exec("sudo python3 /var/www/html/turtleMatchingApp/delaunay2D_plotDemo.py \"".$matchX."\" \"".$matchY."\" ".$filename);
  echo $result;
  //echo "<br>";

?>

