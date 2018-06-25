<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
}

  
  $rightX = $_POST['rightX'];
  $rightY = $_POST['rightY'];
  $turtle_id = $_POST['turtleId'];
  $rightName = "".$turtle_id."_Right";

  $result = shell_exec("sudo python3 /var/www/html/turtleMatchingApp/delaunay2D_plotDemo.py \"".$rightX."\" \"".$rightY."\" ".$rightName);
  echo $result;
 $rightExists = file_exists("./Turtle/".$rightName.".png");
  echo "<br>";
?>

