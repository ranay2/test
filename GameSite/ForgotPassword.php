<!DOCTYPE html>
<html>
    <head>
        <link href="css/Space-login.css" rel="stylesheet"/>
        <title>Forgot Password</title>
    </head>
    <body>
        <div id="centred">
            <div id="container">
                <div id="logo">
                    <img id="icon" src="images/icons/spaceship.png"/>
                    <h1>STARCADE</h1>
                </div>
                <form action="SendCode.php" method="POST">
                    <label>Email</label>
                    <input class="textField" type="text" name="email" placeholder="Enter Your Email Address" required/>
                    <input type="submit" name="submit" value="next" />
                </form>
            </div>
        </div>
    </body>
</html>