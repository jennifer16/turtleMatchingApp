<?php
  session_start();
  require 'connect.php';
print_r($_POST);

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
  $width = $_POST['width'];
  $length = $_POST['length'];
  $weight = $_POST['weight'];
  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];

  $userid = $_SESSION['user_id'];
  $userRole = $_SESSION['user_role'];

$sql1 = "INSERT INTO turtle (turtle_name, turtle_left, turtle_right, turtle_profile, turtle_type, turtle_age_moth, turtle_microchip_code, turtle_microchip_pos, turtle_tag_code, turtle_tag_pos)
VALUES ('".$turtleName."', '".$leftFile."', '".$rightFile."' , '".$profileFile."', '".$turtleType."', '".$ageMonth."', '".$microchipCode."','".$microchipPos."','".$tagCode."','".$tagPos."')";


if (mysqli_query($conn, $sql1)) {
    $last_id = mysqli_insert_id($conn);
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    
    if( !isset($_POST['matchId']))
    {
        $sql2 = "INSERT INTO found (turtle_id, user_id, found_weight, found_width, found_length, found_lat, found_lng, found_picure, found_status ) VALUES ('".$last_id."', '".$userid."','".$weight."','".$width."','".$length."','".$latitude."','".$longitude."','".$profileFile."','1') ";
    }else{
        
         $sql2 = "INSERT INTO found (turtle_id, user_id, found_weight, found_width, found_length, found_lat, found_lng, found_picure, found_status ) VALUES ('".$last_id."', '".$userid."','".$weight."','".$width."','".$length."','".$latitude."','".$longitude."','".$profileFile."','0') ";
    }
    
    if ( mysqli_query($conn, $sql2) ){
        
        if( !isset($_POST['matchId']))
        {
            
            header('Location: selectPointLeft.php?turtle_id='.$last_id);
        }
        else
        {
            $sql3 = "UPDATE matching set turtle_id='".$last_id."' WHERE id='".$_POST['matchId']."';";
            if( mysqli_query($conn, $sql3) )
            {
                        echo "<html>";
        echo "<body>";

        echo "<script>";
    
       	echo "window.open('https://www.facebook.com/sharer/sharer.php?u=https%3A//studioxpert.com/turtleMatchingApp/');";
        
        echo "window.open('selectPointLeft.php?turtle_id=".$last_id."','_self');";
    
        echo "</script>";
    

    
        echo "</body>";


        echo "</html>";
                
            }
            else{
                
                echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
            }
        }
        
        
        
        
    }else{
        
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        //header('Location: error.php');
    }
    
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    //header('Location: error.php');
}




?>
