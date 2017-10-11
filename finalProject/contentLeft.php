<?php include_once('nav.php'); ?>

<div class="sideBox">
	<img src="assets/dont-miss-out.png" alt="tape icon">
	<p>Follow trusted reviewers</p>
	<hr>
	<p>Get a personalized activity feed</p>
	<hr>
	<p>Share your own ratings and reviews</p>
	
	<?php
	if (isset($_COOKIE['username'])) {
		// show log out button
		echo '<a href="logOut.php" class="button1">Log Out</a>';
	}
	else {
		//show log in button
		echo '<a href="signUp.php" class="button1">Join OK.com</a>';
		echo '<a href="logIn.php" class="button2">Sign In</a>';
	}
	?>
</div>

<div class="socialIconsSide">
	<ul>
		<li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
		<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
		<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
		<li><a href="#"><i class="fa fa-google-plus-official"></i></a></li>
	</ul>
</div><!--//end of social icons-->


<div class="sideBox2">
<p>© 2017 Ok.com  | <a href="#">Our Mission</a> | <a href="#">For Publishers</a> | <a href="#">Contact Us</a> | <a href="#">Terms of Service</a> | <a href="#">Privacy Policy</a></p>
</div><!-- end of sideBox 2-->