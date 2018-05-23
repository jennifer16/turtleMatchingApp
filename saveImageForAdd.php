<?php

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}


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
    
    compress($file_name,$file_name,75); 
     
    print_r($file_name);}
?>
