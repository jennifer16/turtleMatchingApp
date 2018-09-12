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
 echo "<br>";
	echo "sudo python3 /var/www/html/turtleMatchingApp/delaunay2D_plotDemo.py \"".$matchX."\" \"".$matchY."\" ".$filename;
  
  echo "<br>checking "." ./Turtle/".$filename.".png<br>";
  $fileExists = file_exists("./Turtle/".$filename.".png");
  echo $fileExists;
  if ($fileExists)
        header("Location:doMatching.php?match_id=".$matchId);
  else
      header("Location:error.php");
?>

