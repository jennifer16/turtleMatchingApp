<?php
  session_start();
  require 'connect.php';

  $turtleId = $_POST['turtleId'];
  $matchId = $_POST['matchId'];
  $width = $_POST['width'];
  $length = $_POST['length'];
  $weight = $_POST['weight'];   
  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];
  $pic = $_POST['filenameProfile'];

  if( $pic[0]=='.'){
      
      $fname = substr($pic,8);
      copy($pic,"./Turtle/".$fname);
      $pic = $fname;
      
  }

  $userid = $_SESSION['user_id'];

$sql1 = "INSERT INTO found (turtle_id, user_id, found_width, found_length, found_weight, found_lat, found_lng, found_picure, found_status)
VALUES ('".$turtleId."', '".$userid."', '".$width."' , '".$length."', '".$weight."', '".$latitude."', '".$longitude."', '".$pic."','1')";


if (mysqli_query($conn, $sql1)) {
    
    $sql2 = "UPDATE matching set turtle_id='".$turtleId."' where id='".$matchId."'";
    if (mysqli_query($conn, $sql2)) {
        //header('Location: success.php');
        echo "<html>";
        echo "<body>";

        echo "<script>";
    
        echo "window.open('https://www.facebook.com/sharer/sharer.php?u=https%3A//studioxpert.com/turtleMatchingApp/');";
        
        echo "window.open('success.php','_self');";
    
        echo "</script>";
    

    
        echo "</body>";


        echo "</html>";
    
    }
    else{
        
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    }
}
else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    //header('Location: error.php');
}


?>

