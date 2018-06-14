<!DOCTYPE html>
<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
}

  
  $leftX = $_POST['leftX'];
  $leftY = $_POST['leftY'];
  $rightX = $_POST['rightX'];
  $rightY = $_POST['rightY'];
  $turtle_id = $_POST['turtleId'];

  $leftName = "".$turtle_id."_Left";
  $rightName = "".$turtle_id."_Right";
  
  $result = shell_exec("sudo python3 /var/www/html/turtleMatchingApp/delaunay2D_plotDemo.py \"".$leftX."\" \"".$leftY."\" ".$leftName);
  echo $result;
  //echo "<br>";


  $result = shell_exec("sudo python3 /var/www/html/turtleMatchingApp/delaunay2D_plotDemo.py \"".$rightX."\" \"".$rightY."\" ".$rightName);
  echo $result;

  echo "<br>";
echo $turtle_id;
?>

