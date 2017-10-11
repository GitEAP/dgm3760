<?php
require_once('connectvars.php');
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection Failed');

if (isset($_POST['submit'])) {
	$first = mysqli_real_escape_string($dbconnection, trim($_POST['first']));
	$last = mysqli_real_escape_string($dbconnection, trim($_POST['last']));
	$username = mysqli_real_escape_string($dbconnection, trim($_POST['username']));
	$password1 = mysqli_real_escape_string($dbconnection, trim($_POST['password1']));
	$password2 =  mysqli_real_escape_string($dbconnection, trim($_POST['password2']));

	//Validation
	if (($password1 == $password2) && !empty($username) && !empty($password1) && !empty($password2) ) {
		//Check if someone else has the same username
		$query = "SELECT * FROM final_user WHERE username='$username'";
		
		$alreadyexists = mysqli_query($dbconnection, $query) or die('Select Query failed');
		
		//if name doesn't already exist than insert to database else tell user to choose a different username.
		if (mysqli_num_rows($alreadyexists) == 0) {
			//INSERT DATA
			$query = "INSERT INTO final_user (first, last, username, password)" . "VALUES ('$first', '$last', '$username', SHA('$password1'))";

			mysqli_query($dbconnection, $query) or die('Insert Query Failed');

			//confirm message
			$feedback = 'Your new account has been successfully created.<br><br>' . '<a href="index.php">Back to home page</a>';
			$feedbackStatus = 'feedback';

			//make cookies
			setcookie('firstname', $first, time() + (60*60*24*30));
			setcookie('lastname', $last, time() + (60*60*24*30));
			setcookie('username', $username, time() + (60*60*24*30)); //expires in 30 days

			//Close connection
			mysqli_close($dbconnection);

		}else {
			$feedback = 'Sorry, Someone has that username, choose a different one.';
			$feedbackStatus = 'feedbackError';
			$username = '';
		}
		//end of check for duplicate usernames
		}//end of validation
}
?>
<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">

	<div class="contentContainer clearfix">

		<aside class="contentLeft">
		<?php include_once('contentLeft.php'); ?>
		</aside>

		<section class="contentRight"> <!-- main page content goes here-->
		
		<h2>Sign Up</h2>
		
		<div class="<?php echo $feedbackStatus; ?>"><?php echo $feedback; ?></div>
		
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="mainForm">
			<fieldset>
				<legend>General Information</legend>
				<label><span>First Name:</span><input type="text" name="first" placeholder="John" class="userInput" pattern="[a-zA-Z.-/, ]{2,99}" value="<?php if(!empty($first)){echo $first;} ?>" required></label>
				<label><span>Last Name:</span><input type="text" name="last" placeholder="Doe" class="userInput" pattern="[a-zA-Z.-/, ]{2,99}" value="<?php if(!empty($last)){echo $last;} ?>" required></label>
				<label><span>Username:</span><input type="text" name="username" placeholder="Enter a username" class="userInput" pattern="[a-zA-Z.-/, ]{2,99}" value="<?php if(!empty($username)){echo $username;} ?>" required></label>
				<label><span>Password</span><input type="password" name="password1" placeholder="Enter a password" class="userInput" required></label>
				<label><span>Retype Password</span><input type="password" name="password2" placeholder="Retype password" class="userInput" required></label>
			</fieldset>
			<input type="submit" name="submit" value="Sign Up" class="submitButton">
		</form>

		</section><!--//end of content right			-->
	</div><!--//end of content container-->
</main>
</body>
</html>