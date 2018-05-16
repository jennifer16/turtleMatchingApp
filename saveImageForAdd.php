<?php

 	$file_to_upload = $_FILES['avatar']['tmp_name'];
    $filename = $_POST['filename'];
	$file_name = './Turtle/'.$filename;
    move_uploaded_file($file_to_upload, 'test.JPG');
    print_r($_POST);
?>
