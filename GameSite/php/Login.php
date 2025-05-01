<?php
    include ('connection.php');
    session_start(); 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $admin = $_POST['isAdmin'] === 'on' ? true : false;

        if($admin){
            $sql = "SELECT * FROM admin WHERE Username = ? OR email = ?";  
        }else{
            $sql = "SELECT * FROM user WHERE Username = ? OR email = ?";  
        }

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ss", $username, $username);
    
            if ($stmt->execute()) {
                $resultSet = $stmt->get_result();
                if($resultSet->num_rows == 1){
                    $user = $resultSet->fetch_assoc();
                    if(password_verify($password, $user['Password'])){      //compare entered password with hashed one
                        $_SESSION['username'] = $user['Username'];
                        if($admin){
                            header("Location: ../Dashboard.php");
                            exit();
                        }else{
                            header("Location: ../MainPage.php");
                            exit();
                        }
                    }else{
                        echo 'incorrect password';
                    }
    
                }else{
                    echo "no account with that username.";
                }
            } else {
                echo "Statement Error: " . $stmt->error;
            }
    
        } else {
            echo "Connection Error: " . $conn->error;
        }
    
        $conn->close();

    }  
?>