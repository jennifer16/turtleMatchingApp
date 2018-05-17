<?php
  session_start();
  require 'connect.php';

  $turtleName = $_POST['turtleName'];
  $turtleType =  $_POST['turtleType'];
  $leftFile = $_POST['filenameLeft'];
  $rightFile = $_POST['filenameRight'];
  $profileFile = $_POST['filenameProfile'];
  $ageYear = $_POST['ageYear'];
  $ageMonth = $_POST['ageMonth'];
  $microchipCode = $_POST['microchipCode'];
  $microchipPos = $_POST['microchipPos'];
  $tagCode = $_POST['tagCode'];
  $tagPos = $_POST['tagPos'];

  $turtleID = $_POST['turtleID']

      
$sql = "UPDATE turtle SET turtle_name='".$turtleName."', turle_left='".$turtle_left."', turtle_right='".$turtle_right."', turtle_profile='".$turtle_profile."', turtle_age_moth='".$ageMonth."', turtle_age_year='".$ageYear."',turle_microchip_code='".$microchipCode."', turtle_microchip_pos='".$micrpchipPos."', turtle_tag_code='".$tagCode."', turtle_tag_pos='".$tagPos."' WHERE turtle_id='".$turtleID."'";
      
echo $sql;


//if (mysqli_query($conn, $sql1)) {

    
//} else {
//    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    //header('Location: error.php');
//}




?>