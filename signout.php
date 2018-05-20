<?php
require_once __DIR__ . '/Facebook/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '161713021336907',
  'app_secret' => 'e4dbd79e0e6da4d75019803b487214d2',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);
    $helper = $fb->getRedirectLoginHelper();
 $helper->getLogoutUrl();
echo $fb;

    session_destroy();
 
   // header('Location:'.$url);
?>