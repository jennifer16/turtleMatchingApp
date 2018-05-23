
<?php
session_start();
require_once __DIR__ . '/Facebook/autoload.php';
require 'connect.php';

$fb = new Facebook\Facebook([
  'app_id' => '161713021336907',
  'app_secret' => 'e4dbd79e0e6da4d75019803b487214d2', 
  'default_graph_version' => 'v2.10',
  ]);


$fb->destroySession();

    session_destroy();
 
    header('Location:login.php');
?>