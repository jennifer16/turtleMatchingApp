<?php
  session_start();
  require 'connect.php';
  
  $leftX = $_POST['leftX'];
  $leftY = $_POST['leftY'];
  $rightX = $_POST['rightX'];
  $rightY = $_POST['rightY'];
  $turtle_id = $_POST['turtleId'];

  $leftName = "".$turtle_id."_Left";
  $rightName = "".$turtle_id."_Right";

 
  $result = shell_exec("python delaunay2D_plotDemo.py \"".$leftX."\" \"".$leftY."\" ".$leftName);
  echo $result;


  $result = shell_exec("python delaunay2D_plotDemo.py \"".$rightX."\" \"".$rightY."\" ".$rightName);
  echo "<br>";
   echo $result;
?>