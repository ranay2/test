<?php

include ('connection.php');
session_start();    // temporary login state to store info about the user across pages.

if (!isset($_SESSION['Username'])) {
    echo "You must be logged in to change your password.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST['new-pass'];
    $confirmation = $_POST['confirm-pass'];

    $sql = "UPDATE user SET Password = ? WHERE Username = ?";    //change pass in table

    if($password == $confirmation) {
        if($stmt = $conn->prepare($sql)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("ss", $hashed_password, $_SESSION['Username']);
            if($stmt->execute()){
                echo "Password changed successfully!";
            }else{
                echo "Statement Error: " . $stmt->error;
            }
        } else {
            echo "Connection Error: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "passwords don't match";
    }
}
?>