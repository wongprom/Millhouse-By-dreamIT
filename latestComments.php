<!DOCTYPE html>
<html lang="en">
<head>
	<?php require 'head.html'; ?>
	<title>Latest comments</title>
</head>   
<body>

<?php

$pdo = new PDO(
  "mysql:host=localhost;dbname=millhouse;charset=utf8",
  "root",
  "root"
);

//hantering av felmeddelande
$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//hinder mot simulerade förfrågningar
$pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);




    $statement = $pdo->prepare("SELECT commentText From comments"
    );

    $statement->execute();

    $allComments = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require 'logoheader.html'; ?>
<?php require 'navbar.php'; ?>
<main>
<!--Profile Box-->
<div class="profileBox"> 
        <!--USER IMAGE-->
            <div class="profileBox__content-1">
                <img src="" alt="">
                <div class="userImage">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </div>
        
                <!--edit icon from bootsrap?-->
                <!--USER NAME-->
                <div class="profileBox__content-username">
                    <p class="username">Username</p>
                    <p class="aboutMe">Something About Me</p>
                </div>
    
                <div class="settingsIcon">
                    <button class="settings">
                        <a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
                    </button>
                </div>
            </div>
                <div class="clear"></div>
            
            <div class="profileBox__content-2">
                <div class="profileBox__content-commentsPosts">
                    <div class="totalPosts">
                        <a href="#">50 blogposts</a>
                    </div>
                    <div class="totalComments">
                        <a href="#">125 comments</a>
                    </div>
                </div>
                <div class="createNewPost">
                    <button class="create">
                        <a href="createPost.php">Create New Post</a>
                    </button>
                </div>
            </div>
            
            <!--settings icon from bootstrap?-->
        </div>
            <!--BOOTSTRAP SECOND NAV-->
            <nav class="nav nav-pills nav-justified">
                <a class="nav-item nav-link" href="profilePage.php">Profile</a>
                <a class="nav-item nav-link" href="latestPosts.php">Latest Posts</a>
                <a class="nav-item nav-link active" href="latestComments.php">Latest Comments</a>
            </nav>
	<!--latest comments-->
	<div class="container-wrapper">
    <?php foreach($allComments as $allComment){?>
		<div  class= "container-latestComments">
            <!--CATEGORY TAG-->
			<article>			
			<h2>BLOG POST TITLE</h2>
			<h4>Commented for  <time><?php echo date("Y/m/d");?></time> days ago.</h4>
			<p><?php echo $allComment['commentText']; ?> </p>
			<button><i class="fa fa-pencil" aria-hidden="true"></i><a href="/editPost.php">Edit</button></a>
			<button><i class="fa fa-trash" aria-hidden="true"></i><a href="#"> Delete</button></a>
			</article>	
		</div>
        <?php }?>
	</div> 
	     
	</main>

	
<?php require 'footer.php'; ?>
<?php require 'bootstrapScripts.html'; ?>


</body>
</html>
