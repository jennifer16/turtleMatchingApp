<?php

    if (!$_POST['filenameLeft']==""){
 	$file_to_upload = $_FILES['avatarLeft']['tmp_name'];
    $filename = $_POST['filenameLeft'];
	$file_name = './Turtle/'.$filename;
    move_uploaded_file($file_to_upload, $file_name);
    print_r($file_name);}

    if (!$_POST['filenameRight']==""){
 	$file_to_upload = $_FILES['avatarRight']['tmp_name'];
    $filename = $_POST['filenameRight'];
	$file_name = './Turtle/'.$filename;
    move_uploaded_file($file_to_upload, $file_name);
    print_r($file_name);}
?>
