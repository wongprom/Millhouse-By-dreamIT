<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'head.html'; ?>
	<title>User setttings</title>
</head>

<body>

<?php require 'logoheader.html'; ?>
<?php require 'partials/navbar.php';  ?>

    <main>
        <div class="mainBody">
            <div class="form_wrapper">
                <div class="form_heading">
                    <h1>Settings</h1>
                    <p>Change your settings here.</p>
                    <br>
                </div>

                <div class="form_section">
                    <form class="form" action="" method="POST">
                        <fieldset class="fieldset">
                            <div class="form_input">
                                <input type="text" id="username"  name="username" value="" placeholder="New Username" /><br>
                                <input type="text" id="email" name="email" value="" placeholder="New Email*" /><br>
                                <input type="text" id="email" name="email" value="" placeholder="Repeat Email*" /><br>
                                <input type="text" id="password" name="password" value="" placeholder="New Password*" /><br>
                                <input type="text" id="passwordConfirm" name="passwordConfirm" value="" placeholder="Confirm New Password*" /><br>
                            </div>
                            
                            <div class="form_submit">
                                <input type="submit" value="Submit" />
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php require 'footer.php'; ?>
<?php require 'bootstrapScripts.html'; ?>

</body>
</html>
