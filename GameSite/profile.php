<?php
    include('php/connection.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: LoginForm.php");
        exit();
    }

    $sql = "SELECT picture FROM user WHERE Username = ?";

    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("s", $_SESSION['username']);
        if ($stmt->execute()) {
            $users = $stmt->get_result();
            if($users->num_rows == 1){
                $user = $users->fetch_assoc();
            }else{
                echo "Username doesn't exist";
            }
        }else{
            echo "Statement Error: " . $stmt->error;
        }
    }else{
        echo "Connection Error: " . $conn->error;
    }

    $pic = isset($user['picture']) ? $user['picture'] : "default";
    $_SESSION['profile-pic'] = "images/profile-pics/$pic.jpg";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
        <link rel="stylesheet" href="css/ProfilePage.css"/>
        <script src="js/mechanism.js" defer></script>
        <title>Profile Page</title>
    </head>
    <body>
        <div id="navigation">
            <div id="nav-left">
                <img id="icon" src="images/icons/spaceship.png"/>
                <h1>STARCADE</h1>
            </div>
            <div id="nav-right">
                <div id="nav-choices">
                    <a href="MainPage.php">HOME</a>
                    <a href="#about">ABOUT</a>
                    <a href="#contact">CONTACT US</a>
                    <a href="leaderboard.php">LEADERBOARD</a>

                    <div class="dropdown-menu">
                        <button class="dropdown-button"><?php echo htmlspecialchars($_SESSION['username']); ?> ▼</button>
                        <div class="dropdown-content">
                            <a href="profile.php">View Profile</a>
                            <a href="php/logout.php">Logout</a>
                        </div>
                    </div>                         
                </div>   
                <div> 
                    <form class="search-bar">                                   <!--HANDLE IN JAVASCRIPT-->
                        <input type="search" placeholder="Search" required>
                        <button type="submit">
                            <img src="images/icons/search.png" width="16px" height="16px" alt="search"/>
                        </button>
                    </form>
                </div>    
            </div>
        </div>


        <div id="content">
           <div id="user-info">
                <img src="<?= $_SESSION['profile-pic'] ?>" id="edit-profile-pic"/>

                <div id="username">
                    <h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
                    <!-- From Uiverse.io by aaronross1 --> 
                    <a href="editProfile.php">
                    <button class="edit-button">
                    <svg class="edit-svgIcon" viewBox="0 0 512 512">
                        <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                    </svg>
                    </button>
                    </a>
                </div>
           </div>
           <div id="profile-details">
                <h1>HIGHSCORES</h1>
                <div id="highscores">
                    <!-- DYNAMIC HIGHSCORES -->
                    <?php
                    $sql = "SELECT scores.Highscore, games.name, games.logo 
                            FROM games 
                            INNER JOIN scores ON games.game_id = scores.Game_id 
                            WHERE scores.Username = ? AND scores.Highscore IS NOT NULL AND scores.Highscore > 0";

                    if($stmt = $conn->prepare($sql)){
                        $stmt->bind_param("s", $_SESSION['username']);
                        if ($stmt->execute()) {
                            $games = $stmt->get_result();
                            if($games->num_rows > 0){

                                while($row = $games->fetch_assoc()){
                                    $game_name = $row['name'];
                                    $game_logo = $row['logo'];
                                    $highscore = $row['Highscore'];

                                    echo "<div class='highscore_entry'>";
                                    echo "<div class='score'>";
                                    echo "<h3>" . htmlspecialchars($game_name) . "</h3>";
                                    echo "<p>" . htmlspecialchars($highscore) . "</p>";
                                    echo "</div>";
                                    echo "<img src='" . htmlspecialchars($game_logo) . "' alt='Game Logo' />";
                                    echo "</div>";
                                }
                            }else{
                                echo "Play games to get a score";
                            }
                        }else{
                            echo "Statement Error: " . $stmt->error;
                        }
                    }else{
                        echo "Connection Error: " . $conn->error;
                    }
                    ?>
                </div>
           </div>
        </div>



        <div id="sections">
            <div id="about">
                <h4>ABOUT</h4> 
                <p class="aboutText">this project was made by 4 members for the assessment 
                    of the Web Programming subject. I need more content to type but i have 
                    no idea what it's gonna be i have nothing in my brain right now :3
                </p>
            </div>
            <div id="contact">
                <h4>CONTACT US</h4>
                <div class="contact-icons">
                    <!-- Custom Phone Icon -->
                    <a href="tel:+1234567890">
                        <img src="images/icons/phone.png" alt="Phone" class="icon" />
                    </a>
                    <!-- Custom Email Icon -->
                    <a href="mailto:dohaymanesmail@gmail.com">
                        <img src="images/icons/mail.png" alt="Email" class="icon" />
                    </a>
                    <!-- Custom Social Media Icons -->
                    <a href="https://www.facebook.com" target="_blank">
                        <img src="images/icons/facebook.png" alt="Facebook" class="icon" />
                    </a>
                    <a href="https://www.twitter.com" target="_blank">
                        <img src="images/icons/x.png" alt="Twitter" class="icon" />
                    </a>
                </div>
            </div>
        </div>
        <div id="up">
            <button id="backToTop"><img src="images/icons/up-arrow.png" width="16px" height="16px"/></button>  <!--HANDLE IN JAVASCRIPT-->
        </div>
    </body>
</html>