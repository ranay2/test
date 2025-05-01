<?php
    include("php/connection.php");
    session_start();
    $_SESSION['game_id'] = isset($_GET['game']) ? $_GET['game'] : '404Page';

    $game = $_SESSION['game_id'];

    $sql = "SELECT game_id FROM games WHERE game_id = ?";

    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("s", $game);

        if ($stmt->execute()) {
            $available_games = $stmt->get_result();
            if($available_games->num_rows == 1){
                $row = $available_games->fetch_assoc();

                if ($game == $row['game_id']) {
                    $src = "$game/$game.html";
                } else {
                    header("Location: 404Page/404Page.html");
                }
            }else{
                echo "no game with that id.";
            }
        }else {
            echo "Statement Error: " . $stmt->error;
            header("Location: 404Page/404Page.html");
        }
    } else {
        echo "Connection Error: " . $conn->error;
        header("Location: 404Page/404Page.html");
    }

    $conn->close(); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
        <link rel="stylesheet" href="css/gamePage.css"/>
        <script src="js/mechanism.js" defer></script>
        <script src="js/updateScore.js" defer></script>
        <title>Game</title>
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
                    <form class="search-bar">                                                                                            <!--HANDLE IN JAVASCRIPT-->
                        <input type="search" placeholder="Search" required>
                        <button type="submit">
                            <img src="images/icons/search.png" width="16px" height="16px" alt="search"/>
                        </button>
                    </form>
                </div> 
            </div>   
        </div>
        <div id="container">
            <div id = "gamePlane">
                    <iframe id="game" src="<?= $src ?>"> </iframe>                                                                                   
            </div>
            <div id = "side">
                <div id="AdventureTime" class="card"><p>Adventure Time</p></div>
                <div id="ClickerCat" class="card"><p>Clicker Cat</p></div>
                <div id="FroggyQuest" class="card"><p>Froggy Quest</p></div>
                <div id="FlappyBee" class="card"><p>Flappy Bee</p></div>
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
            <button id="backToTop"><img src="images/icons/up-arrow.png" width="16px" height="16px"/></button>                               <!--HANDLE IN JAVASCRIPT-->
        </div>
    </body>
</html>