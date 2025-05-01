<!--STEPS
    1. CONNECT TO database
    2. CREATE A PREPARED STATEMENT
    3. ADD VALUES TO STATEMENT
    4. EXECUTE STATEMENT QUERY
    5. CLOSE CONNECTION
-->


<?php
include ('connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Debugging
    //echo "Username: $username<br>";
    //echo "Email: $email<br>";

    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        //echo "match!";
        //Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (username, password, email) VALUES (?, ?, ?)";

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sss", $username, $hashed_password, $email);

            if ($stmt->execute()) {
                //echo "User added successfully!";
                header("Location: ../LoginForm.php");  //Redirect to login page
                exit(); //stop this php to go to next
            } else {
                echo "Error: " . $stmt->error;
            }

        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    }
}
?>
