<?php
//starts sesson, get pdo connection and fetches validateLoginInput function 
session_start();    
require_once '../config.php';
require_once DIRBASE . 'database/db.php';
require_once DIRBASE . 'database/functions.php';

//variable used to print out message if there is no user found or if
//user writes the wrong username or password
$loginError = false;

//when submnit button is pushed the function to check for users in database
//is called och if it returns a user sh/e gets redirected to homepage if it
//returns null the user returns to loginpage and receives a error message
if (isset($_POST['submit'])) {

    if (isset($_POST['username'])){
        $user = validateLoginInput();
        if ($user["username"] == $_POST['username']) {
            if (password_verify($_POST['password'], $user['password'])){
                $_SESSION['userID'] = $user['userID'];
                //saves userID in cookie that lasts for an hour
                setcookie("userID", $user['userID'], time() + 3600, "/"); 
                //saves corresponding userpassword (hashed) in order to
                //make it harder for someone to access userlogin by changing
                //the userID in the browser 
                setcookie("userHash", $user['password'], time() + 3600, "/"); 
                //redirects to index
                header('Location: ../index.php');   
            }       
        } else {
            $loginError = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once DIRBASE . 'partials/head.php'; ?>
    <title>Login</title>
    <meta name="description" content="Login to Millhouse stories.">
</head>
<body>

<?php 
require DIRBASE . 'partials/logoheader.html';
require DIRBASE . 'partials/navbar.php'; 
?>

<main>
    <div class="main">
        <div class="mainBody">
            <div class="form_wrapper"> 
                <div class="login_wrapper">   
                    <form class="form" method="post" enctype="multipart/form-data">
                        <div class="topInfo">
                            <legend class="legend"><h1>Login</h1></legend>
                            <p class="topInfo__instruction">Login to your account here.</p>
                        </div>
                        <fieldset class="fieldset">
                            <div class="loginForm">
                                <div class="loginForm__input">
                                    <label for="username" class="login-label">Username</label>
                                    <!-- checks if user has put in their login info correctly 
                                    and then prints a message if sh/e has filled in something wrong
                                    or simply do not have an account -->
                                    <?php if ($loginError): ?>
                                        <span class="error-msg">Wrong username or password
                                        </span>
                                    <?php endif; ?>
                                    <input type="text" name="username" value="" placeholder="Email or Username"/><br>
                                    <label for="username" class="login-label">Password</label>
                                    <input type="password" name="password" value="" placeholder="Password"/><br>
                                </div>
                            </div>
                            <div class="submitButton">
                                <input name="submit" type="submit" value="Log In"/><br>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!-- links the user to register page -->
                <div class="loginForm__newAccount-link">
                Not a member yet? <a href="pages/register.php">Create Account.</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require DIRBASE . 'partials/footer.php';
require DIRBASE . 'partials/bootstrapScripts.html';
?> 

</body>
</html>
