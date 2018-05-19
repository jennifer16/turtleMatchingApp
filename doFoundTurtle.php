<?php
  session_start();
  require 'connect.php';
print_r($_POST);

  $turtleName = $_POST['turtleName'];
  $width = $_POST['width'];
  $length = $_POST['length'];
  $weight = $_POST['weight'];   
  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];
  $pic = $_POST['filenameProfile'];

  $userid = $_SESSION['user_id'];
 

  $sql1 = "select  * from turtle where turtle_name = '".$turtlename."'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    $turtle_id = $row['turtle_id']

$sql2 = "INSERT INTO found (turtle_id, user_id, found_width, found_length, found_weight, found_lat, found_lng, found_picure, found_status)
VALUES ('".$turtleName."', '".$userid."', '".$width."' , '".$length."', '".$weight."', '".$latitude."', '".$longitude."', '".$pic."','1')";


if (mysqli_query($conn, $sql2)) {
        header('Location: success.php');
else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    //header('Location: error.php');
}
    
    

?>