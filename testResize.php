<?php
    
    $tn = './Turtle/JcYmU56Vww.JPG';
    $save = './Turtle/NaTest.JPG';
 
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

$source_img = 'source.jpg';
$destination_img = 'destination .jpg';

$d = compress($tn, $save, 75);

?>