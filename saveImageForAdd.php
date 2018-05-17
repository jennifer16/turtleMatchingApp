<?php

 	$file_to_upload = $_FILES['avatarLeft']['tmp_name'];
    $filename = $_POST['filenameLeft'];
	$file_name = './Turtle/'.$filename;
    move_uploaded_file($file_to_upload, $file_name);
    print_r($file_name);
?>
