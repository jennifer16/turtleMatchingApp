<?php
  session_start();
  require 'connect.php';

  $turtleName = $_POST['turtleName'];
  $turtleType =  $_POST['turtleType'];
  $leftFile = $_POST['filenameLeft'];
  $rightFile = $_POST['filenameRight'];
  $profileFile = $_POST['filenameProfile'];
  $ageMonth = $_POST['ageMonth'];
  $microchipCode = $_POST['microchipCode'];
  $microchipPos = $_POST['microchipPos'];
  $tagCode = $_POST['tagCode'];
  $tagPos = $_POST['tagPos'];

  $turtleID = $_POST['turtleID'];

      
$sql = "UPDATE turtle SET turtle_name='".$turtleName."', turtle_left='".$leftFile."', turtle_right='".$rightFile."', turtle_profile='".$profileFile."', turtle_age_moth='".$ageMonth."',turtle_microchip_code='".$microchipCode."', turtle_microchip_pos='".$microchipPos."', turtle_tag_code='".$tagCode."', turtle_tag_pos='".$tagPos."' WHERE turtle_id='".$turtleID."'";

if (mysqli_query($conn, $sql)) {

    header('Location: success.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //header('Location: error.php');
}




?>