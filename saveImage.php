<?php

 	$file_to_upload = $_FILES['avatar']['tmp_name'];
    $filename = $_POST['filename'];
	$file_name = './Input/'.$filename;
    move_uploaded_file($file_to_upload, $file_name);
echo $file_to_upload;
?>
