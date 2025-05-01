<?php
    include ("connection.php");
    session_start(); //to store email verification data
    //$timeout_duration = 900; //code expires after 15 mins

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mail = $_POST['email'];  

        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) { //mail validation
            //if valid check if there's an account for that email

            $sql = "SELECT email FROM user WHERE email = ?";

            if($stmt = $conn->prepare($sql)){
                $stmt->bind_param("s", $mail);
        
                if ($stmt->execute()) {
                    $resultSet = $stmt->get_result();
                    if($resultSet->num_rows == 1){
                        $code = random_int(100000, 999999); // generate 6-digits securely i think

                        $subject = "Your Verification Code";
                        $message = "Your verification code is: $code";
                        $headers = "From: noreply@yoursite.com\r\n";    //email formatting?

                        $_SESSION['email'] = $mail;
                        $_SESSION['verification_code'] = $code;

                        if(mail($mail, $subject,$message, $headers)){
                            header("Location: ../verifyEmail.php");
                            exit();
                        }else{
                            echo "Failed to send verification email.";
                        }

                    }else{
                        echo "no account with that email address.";
                    }
                } else {
                    echo "Statement Error: " . $stmt->error;
                }
            } else {
                echo "Connection Error: " . $conn->error;
            } 
        } else {
            echo "<p> Invalid email address. </p>";
        }

        $conn->close();
    }
?>