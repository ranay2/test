<?php
    include('connection.php');
    session_start();

    $username = $_SESSION['username'];

    $sql = "UPDATE user SET ? = ? WHERE Username = ?";

    if(!empty($_POST['profile_pic'])){
        $attribute = "picture";
        $value = $_POST['profile-pic'];


        $_SESSION['profile-pic'] = $value;
    }
    if(!empty($_POST['new_username'])){
        $attribute = "Username";
        $value = $_POST['new_username'];



        $_SESSION['username'] = $value;
    }
    if(!empty($_POST['email'])){
        $attribute = "Email";
        $value = $_POST['email'];

    }
    if(!empty($_POST['password']) || !empty($_POST['confirmation'])){
        $attribute = "password";
        $value = $_POST['profile-pic'];

    }

    //execution
    // header("Location: ../profile.php");
    // exit();
?>