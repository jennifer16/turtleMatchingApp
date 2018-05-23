<?php
    session_start();
    require 'connect.php';

    $turtleId = $_GET['id'];

    $sql = "DELETE FROM turtle WHERE turtle_id='".$turtleId."'";

    if ($conn->query($sql) === TRUE) {
       $sql = "DELETE FROM found WHERE turtle_id='".$turtleId."'";
       if ($conn->query($sql) === TRUE) {
         header('Location: success.php');
           
       }else{
        //header('Location: error.php');
        echo "Error: " . $sql . "<br>" . $conn->error;           
           
       }
        
    } else {
        //header('Location: error.php');
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
?>