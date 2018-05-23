<?php

    function resize($newWidth, $originalFile) {

        $info = getimagesize($originalFile);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;
            
           case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw new Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($originalFile)) {
            unlink($originalFile);
    }
    $image_save_func($tmp, $originalFile);
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
     resize(1024,$file_name);
    print_r($file_name);}
?>
