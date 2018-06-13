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

  echo "before first image<br>";
  echo "python delaunay2D_plotDemo.py \"".$leftX."\" \"".$leftY."\" ".$leftName;
  $result = exec("python delaunay2D_plotDemo.py \"".$leftX."\" \"".$leftY."\" ".$leftName);
  echo $result;


  //$result = exec("python delaunay2D_plotDemo.py \"".$rightX."\" \"".$rightY."\" ".$rightName);
  //echo "<br>";
   //echo $result;
?>