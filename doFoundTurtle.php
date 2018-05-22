<?php
  session_start();
  require 'connect.php';

   require_once __DIR__ . '/Facebook/autoload.php'; // change path as needed
require_once __DIR__ . '/Facebook/facebook.php'; // change path as needed

$config = array();
$config['appId'] = '161713021336907';
$config['secret'] = 'e4dbd79e0e6da4d75019803b487214d2';
$config['fileUpload'] = false; // optional
 
$fb = new Facebook($config);
 
// define your POST parameters (replace with your own values)
$params = array(
  "access_token" => $_SESSION['fb_access_token'], // see: https://developers.facebook.com/docs/facebook-login/access-tokens/
  "message" => "มาร่วมกันอนุรักษ์เต่าด้วยกันกับแอพคู่มือเต่าทะเล #seaturtle #android #ios",
  "link" => "https://studioxpert.com/turtleMatchingApp/",
  "picture" => "https://studioxpert.com/turtleMatchingApp/Turtle/".$_POST['filenameProfile'],
  "name" => "How to Auto Post on Facebook with PHP",
  "caption" => "www.pontikis.net",
  "description" => "Automatically post on Facebook with PHP using Facebook PHP SDK. How to create a Facebook app. Obtain and extend Facebook access tokens. Cron automation."
);

try {
  $ret = $fb->api('/'.$_SESSION['user_id'].'/feed', 'POST', $params);
  echo 'Successfully posted to Facebook';
} catch(Exception $e) {
  echo $e->getMessage();
}


  $turtleId = $_POST['turtleId'];
  $matchId = $_POST['matchId'];
  $width = $_POST['width'];
  $length = $_POST['length'];
  $weight = $_POST['weight'];   
  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];
  $pic = $_POST['filenameProfile'];

  $userid = $_SESSION['user_id'];

$sql1 = "INSERT INTO found (turtle_id, user_id, found_width, found_length, found_weight, found_lat, found_lng, found_picure, found_status)
VALUES ('".$turtleId."', '".$userid."', '".$width."' , '".$length."', '".$weight."', '".$latitude."', '".$longitude."', '".$pic."','1')";


if (mysqli_query($conn, $sql1)) {
    
    $sql2 = "UPDATE matching set turtle_id='".$turtleId."' where id='".$matchId."'";
    if (mysqli_query($conn, $sql2)) {
        header('Location: success.php');
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

    
