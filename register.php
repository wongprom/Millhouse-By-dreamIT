<?php 
session_start();   
//saves all input from the form in variable
$formData = $_POST;
require_once 'partials/db.php';  
require_once 'functions.php';

$emailError = false;
$passwordError = false;
$usernameNotUniqe = false;

if (isset($_POST['submit'])) {
    //checks if user has filled in both email fields with the same email
    if ($_POST['email'] != $_POST['email-repeat']){
        $emailError = true;        
    }
    //checks if the user has filled in the passwords field with the same email
    if ($_POST['password'] != $_POST['password-repeat']){
        $passwordError = true;        
    }
    //checks if the user has filled in a uniqe username
    if (!isUsernameUniqe($_POST['username'])) {
        $usernameNotUniqe = true;
    }

    $informationComplete = !$emailError 
    && !$passwordError 
    && ! $usernameNotUniqe;

    if($informationComplete) {
    //saves all userinput collected from form into session
    $_SESSION["formData"] = $_POST;        
    //creates new user in database
    $userID = createNewUser($_POST);
    //sign in with new userID
    $_SESSION['userID'] = $userID; 
    //redirects to index
    header('Location: index.php');

    }   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'head.html'; ?>
	<title>Register New Account</title>
<body>

<?php require 'logoheader.html'; ?>
<?php require 'partials/navbar.php';  ?>

<main>
    <div class="main">
        <div class="mainBody">
            <div class="form_wrapper">    
                <form class="form"  method="post">
                    <div class="topInfo">
                        <legend class="legend">
                            <h1>Register</h1>
                        </legend>
                        <p>New to Millhouse? Create your account here.</p>
                        <p>Fields marked with * is mandatory.</p>
                    </div>

                    <fieldset class="fieldset">
                        <div class="createForm">
                            <?php if ($usernameNotUniqe): ?>
                                <span class="error-msg">It allready exists a user with this username</span>
                            <?php endif; ?> 
                            <label for="username" class="createForm__label">Fill in a username *</label>
                            <input type="text" name="username" placeholder="Username" id="headline" value="<?= $formData['username'] ?? '' ?>" required/>                            
                            <?php if($emailError):?>
                                <span class="error-msg">Email doesn't match</span>
                            <?php endif; ?>
                            <label for="email">Fill in your email *</label>
                            <input type="text" name="email" placeholder="Email" value="<?= $formData['email'] ?? '' ?>" required />
                            <label for="email-repeat">Repeat email to confirm *</label>
                            <input type="text" name="email-repeat" placeholder="Repeat Email" value="<?= $formData['email-repeat'] ?? '' ?>" required/>
                            <?php if($passwordError): ?>
                                <span class="error-msg">Password doesn't match</span>
                            <?php endif; ?>
                            <label for="password">Fill in a password *</label>
                            <input type="password" name="password" placeholder="Password"  required/>
                            <label for="password-repeat">Repeat password to confirm *</label>
                            <input type="password" name="password-repeat" placeholder="Confirm Password" required/>
                            <label for="textarea">Describe yourself, this will display in your profile (maximum 32 characters)</label>
                            <textarea name="textarea" rows="1" cols="71" placeholder="For example: I love sunglasses!" value="<?= $formData['textarea'] ?? '' ?>"></textarea>
                        </div> 
                      <div class="submitButton">
                                <input type="submit" name="submit" value="Register"/>
                            </div>
                        </fieldset>
                    </form>
                    <div class="newAccount">
                        Already have an account? <a href="login.php">Log in.</a>
                  </div>
            </div>
        </div>
    </div>
</main>

<?php require 'partials/footer.php'; ?>
<?php require 'bootstrapScripts.html'; ?> 

</body>
</html>
