<?php

    if (isset($_POST['filenameLeft']) && !$_POST['filenameLeft']==""){
 	$file_to_upload = $_FILES['avatarLeft']['tmp_name'];
    $filename = $_POST['filenameLeft'];
	$file_name = './Turtle/'.$filename;
    move_uploaded_file($file_to_upload, $file_name);
    print_r($file_name);}

    if (isset($_POST['filenameRight']) && !$_POST['filenameRight']==""){
 	$file_to_upload = $_FILES['avatarRight']['tmp_name'];
    $filename = $_POST['filenameRight'];
	$file_name = './Turtle/'.$filename;
    move_uploaded_file($file_to_upload, $file_name);
    print_r($file_name);}

 if (isset($_POST['filenameProfile']) && !$_POST['filenameProfile']==""){
 	$file_to_upload = $_FILES['avatarProfile']['tmp_name'];
    $filename = $_POST['filenameProfile'];
	$file_name = './Turtle/'.$filename;
    move_uploaded_file($file_to_upload, $file_name);
    print_r($file_name);}
?>
