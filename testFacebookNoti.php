<?php
session_start();
require_once __DIR__ . '/Facebook/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '161713021336907',
  'app_secret' => 'e4dbd79e0e6da4d75019803b487214d2',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getCanvasHelper();
$permissions = []; // optionnal

$fb->setDefaultAccessToken($_SESSION['fb_access_token']);

	
	// validating the access token
	try {
		$request = $fb->get('/me');
        echo "pass validate";
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo "error found";
		
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	




?>