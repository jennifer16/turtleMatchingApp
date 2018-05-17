<?php
    session_start();
    require 'connect.php';

    $firstname = $_POST['firstname'];
    $lastname =  $_POST['lastname'];
    $nickname = $_POST['nickname'];
    $id = $_SESSION['user_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = 0;

    $sql = "INSERT INTO users (user_id, user_firstname, user_lastname, user_nickname, user_email, user_phone, user_role)
VALUES ('".$id."', '".$firstname."', '".$lastname."' , '".$nickname."', '".$email."', '".$phone."', '".$role."')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['user_email'] = $email;
        $_SESSION['user_firstname'] = $firstname;
        $_SESSION['user_lastname'] = $lastname;
        $_SESSION['user_nickname'] = $nickname;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_phone'] = $phone;
        $_SESSION['user_role'] = $role;
        header('Location: index.php');
    } else {
        header('Location: error.php');
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
?>