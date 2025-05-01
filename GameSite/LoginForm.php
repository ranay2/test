<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="css/Space-login.css" rel="stylesheet"/>
        <title>Login</title>
    </head>
    <body>
    <div id="centred">
        <div id="container">
            <div id="logo">
                <img id="icon" src="images/icons/spaceship.png"/>
                <h1>STARCADE</h1>
            </div>
            <h1>Login</h1>
            <form action="php/Login.php" method="POST">
                <label>Username</label>
                <input class="textField" type="text" name="username" placeholder="Enter your Username or email" required/>
                <label>Password</label>
                <input class="textField" type="password" name="password" placeholder="Enter your password" required/>
                <div id="options">
                    <div id="checkbox">
                        <label class="rememberLabel">
                            <input type="checkbox" name="remember" value="Remember me"/>Remember me 
                        </label>

                        <div id="adminToggle">
                            <input type="checkbox" id="checkboxInput" name="isAdmin">
                            <label for="checkboxInput" class="toggleSwitch"></label>
                            <span id="adminLabel">Admin</span> <!-- New dynamic label -->
                        </div>
                    </div>
                </div>
                <a class='forgot' href="ForgotPassword.php">Forgot Password?</a>
                <input type="submit" name="submit" value="Sign in"/>
            </form>
            <div id="register">
                <h5>Don't have an account?</h5>
                <a href="RegisterationForm.php">Sign Up</a>
            </div>
        </div>
    </div>
    </body>
</html>