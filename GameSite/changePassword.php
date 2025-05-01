<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/Space-login.css" rel="stylesheet"/>
        <title>Change Password</title>
    </head>
    <body>
        <div id="centred">
            <div id="container">
                <div id="logo">
                    <img id="icon" src="images/icons/spaceship.png"/>
                    <h1>STARCADE</h1>
                </div>
                <form action="php/changePass.php" method="POST">
                    <label>Create Password</label>
                    <input class="textField" type="text" name="new-pass" placeholder="Enter new password" required/>
                    <label>Confirm Password</label>
                    <input class="textField" type="text" name="confirm-pass" placeholder="Confirm Password" required/>

                    <input type="submit" name="submit" value="Confirm"/>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
