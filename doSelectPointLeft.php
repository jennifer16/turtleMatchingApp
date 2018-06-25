<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
}

  
  $leftX = $_POST['leftX'];
  $leftY = $_POST['leftY'];
  $turtle_id = $_POST['turtleId'];
  
  $leftName = "".$turtle_id."_Left";
$rightImage = $_POST['rightImage'];
  
  $result = shell_exec("sudo python3 /var/www/html/turtleMatchingApp/delaunay2D_plotDemo.py \"".$leftX."\" \"".$leftY."\" ".$leftName);
  echo $result;
  echo "<br>";
  
  $leftExists = file_exists("./Turtle/".$leftName.".png");

if($leftExists)
    header("location:selectPointRight.php?name=".$rightImage);
//else
    //header("location:error.php");
  
    
?>
