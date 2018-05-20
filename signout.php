<?php

    $token = $_SESSION['fb_access_token'];
$url = 'https://www.facebook.com/logout.php?next=https://studioxpert.com/turtleMatchingApp/&access_token='.$token;
session_destroy();
 
    header('Location:'.$url);
?>