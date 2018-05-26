<?php
session_start();
require_once __DIR__ . '/Facebook/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '161713021336907',
  'app_secret' => 'e4dbd79e0e6da4d75019803b487214d2',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

    $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
	// sending notification to user
	$sendNotif = $fb->post('/' . $_SESSION['user_id'] . '/notifications', array('href' => '?true=43', 'template' => 'click here for more information!'), $fb->getApp()->getAccessToken());
?>