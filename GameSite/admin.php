<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
        <link rel="stylesheet" href="css\dashBoard.css"/>
        <script src="js/mechanism.js" defer></script>
        <script
            src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
            type="module"
            ></script>
        <title>Admin Page</title>
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

            <div id = 'content'>
                <div id = 'wrapper'>
                <h5>Hello :D <br/>what are we planning on doing today!</h5>
                <div id="cardsContainer">
                    <a href="games.php" class="card card-games"><p>Games</p></a>
                    <a href="users.php" class="card card-users"><p>Users</p></a>
                    <a href="reports.php" class="card card-reports"><p>Reports</p></a>
                </div>
                </div>
            </div> 
        
        <div id="sections">
            <div id="about">
                <h4>ABOUT</h4>
                <p class="aboutText">this project was made by 4 members for the assessment 
                    of the Web Programming subject. you're the admin so you should now what to do :p
                </p>
                
            </div>
            <div id="contact">
                <h4>CONTACT US</h4>
                <div class="contact-icons">
                    <a href="tel:+1234567890">
                        <img src="images/icons/phone.png" alt="Phone" class="icon" />
                    </a>
                    <a href="mailto:dohaymanesmail@gmail.com">
                        <img src="images/icons/mail.png" alt="Email" class="icon" />
                    </a>
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
