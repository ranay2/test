<!DOCTYPE html>
<html>
    
    <head>
        <link href="css/Space-login.css" rel="stylesheet"/>
        <title>Two Factor Authentication</title>
    </head>
    <body>
        <div id="centred">
            <div id="container">
                <div id="logo">
                    <img id="icon" src="images/icons/spaceship.png"/>
                    <h1>STARCADE</h1>
                </div>
                <form action="php/verification.php" method="POST">
                    <label>Verify Email</label>
                    <input class="textField" type="text" name="code" placeholder="Enter Verification Code" required/>
                    <p> A verification code has been sent to your email. </p>
                    <input type="submit" name="submit" value="next"/>
                </form>
            </div>
        </div>
    </body>
</html>