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
  $last_id = $conn->insert_id;
  $structure = './Gallery/'.$last_id;

  // To create the nested structure, the $recursive parameter
  // to mkdir() must be specified.

  if (!mkdir($structure, 0777, true)) {
      die('Failed to create folders...');
  }else{

    $uploads_dir = $structure;
      foreach ($_FILES["photos"]["error"] as $key => $error) {
          if ($error == UPLOAD_ERR_OK) {
              $tmp_name = $_FILES["photos"]["tmp_name"][$key];
              // basename() may prevent filesystem traversal attacks;
              // further validation/sanitation of the filename may be appropriate
              $name = basename($_FILES["photos"]["name"][$key]);
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
              }
            }
  }


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
