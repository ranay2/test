<?php
    include("php/connection.php");
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
        <link rel="stylesheet" href="css\mainPage.css"/>
        <script src="mechanism.js" defer></script>
        <title>Main Page</title>
    </head>
    <body>
        <div id="navigation">
            <div id="nav-left">
                <img id="icon" src="images/icons/spaceship.png"/>
                <h1>STARCADE</h1>
            </div>                
            
            <div id="nav-right">
                <div id="nav-choices">
                    <a href="Home.php">HOME</a>
                    <a href="#about">ABOUT</a>
                    <a href="#contact">CONTACT US</a>
                    <a href="leaderboard.php">LEADERBOARD</a>

                    <?php if (isset($_SESSION['username'])): ?>
                        <div class="dropdown-menu">
                            <button class="dropdown-button"><?php echo htmlspecialchars($_SESSION['username']); ?> ▼</button>
                            <div class="dropdown-content">
                                <a href="profile.php">View Profile</a>
                                <a href="php/logout.php">Logout</a>
                            </div>
                        </div>                    
                    <?php else: ?>
                        <a href="LoginForm.php">LOGIN</a>
                    <?php endif; ?>   
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
            <!-- DYNAMIC HIGHSCORES -->
            <?php
                    $sql = "SELECT game_id, Name FROM games";

                    if($stmt = $conn->prepare($sql)){
                        if ($stmt->execute()) {
                            $games = $stmt->get_result();
                            if($games->num_rows > 0){

                                while($row = $games->fetch_assoc()){
                                    $game_id = $row['game_id'];
                                    $game_Name = $row['Name'];

                                    echo "<a href='gamePage.php?game=" . $game_id . "' class='card' 
                                    style=\"background-image: url('images/games/" . $game_id . ".jpg');\">";
                                    echo "<p>" . htmlspecialchars($game_Name) . "</p></a>";
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