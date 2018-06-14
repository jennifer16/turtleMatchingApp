<?php
  session_start();
  require 'connect.php';

  
  $turtleType =  $_POST['turtleType'];
  $leftFile = $_POST['filenameLeft'];
  $rightFile = $_POST['filenameRight'];
  $profileFile = $_POST['filenameProfile'];
  $ageMonth = $_POST['ageMonth'];
  $width = $_POST['width'];
  $length = $_POST['length'];
  $weight = $_POST['weight'];

  $sql = "UPDATE matching set match_left='".$leftFile."' ,match_right='".$rightFile."'
        , match_profile='".$profileFile."' , match_age='".$ageMonth."', match_width='".$width."'
        , match_length='".$length." ,match_weight='".$weight."', match_turtle_type='".$turtleType." WHERE id='".$_POST['matchId']."';";

  if( mysqli_query($conn, $sql3) )
          
        header('Location: successAddMatching.php');
        
    }else{
        
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        //header('Location: error.php');
    }
    




?>