<?php
require_once('connectvars.php');
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');

	if (isset($_POST['submit'])) {
		$first = mysqli_real_escape_string($dbconnection, trim($_POST['first']));
		$last = mysqli_real_escape_string($dbconnection, trim($_POST['last']));
		$user_username = mysqli_real_escape_string($dbconnection, trim($_POST['userName']));
		$user_password1 = mysqli_real_escape_string($dbconnection, trim($_POST['passWord1']));
		$user_password2 = mysqli_real_escape_string($dbconnection, trim($_POST['passWord2']));
		
		//Validation
		if (($user_password1 == $user_password2) && !empty($user_username) && !empty($user_password1) && !empty($user_password1) ) {
			//Check if someone else has the same username
			$query = "SELECT * FROM cookie_users WHERE username='$user_username'";
			$alreadyexists = mysqli_query($dbconnection, $query) or die('Select Query failed');
			//if name doesn't already exist than insert to database else tell user to choose a different username.
			if (mysqli_num_rows($alreadyexists) == 0) {
				//INSERT DATA
				$query = "INSERT INTO cookie_users (first, last, username, password)" . "VALUES ('$first', '$last', '$user_username', SHA('$user_password1'))";
	
				mysqli_query($dbconnection, $query) or die('Insert Query Failed');
				
				//confirm message
				$feedback = 'Your new account has been successfully created.<br>' . '<a href="index.php">Back to main page</a>';

				//make cookies
				setcookie('firstname', $first, time() + (60*60*24*30));
				setcookie('lastname', $last, time() + (60*60*24*30));
				setcookie('username', $user_username, time() + (60*60*24*30)); //expires in 30 days
				
				//Close connection
				mysqli_close($dbconnection);

			}else {
				$feedback = 'Sorry, Someone has that username, choose a different one.';
				$username = '';
			}
			//end of check for duplicate usernames
		}//end of validation
	}//end of isset submit

?>
<?php include_once('htmlHead.php'); ?>

<body>

<?php include_once('nav.php'); //includes header and nav ?>


<main class="mainContent clearfix">

<?php echo $feedback; ?>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="mainForm">
			<fieldset>
				<legend>Sign Up</legend>
				<label><span class="inputTitle">First Name:</span><input class="userInput" name="first" value="<?php if(!empty($first)) { echo $first;} ?>" type="text" placeholder="John" required></label>
				<label><span class="inputTitle">Last Name:</span><input class="userInput" name="last" value="<?php if(!empty($last)) { echo $last;} ?>" type="text" placeholder="Doe" required></label>
				<label><span class="inputTitle">Username:</span><input class="userInput" name="userName" value="<?php if(!empty($user_username)) { echo $user_username;} ?>" type="text" placeholder="username" required></label>
				<label><span class="inputTitle">Password:</span><input class="userInput" name="passWord1" value="" type="password" placeholder="password" required></label>
				<label><span class="inputTitle">Password (retype):</span><input class="userInput" name="passWord2" value="" type="password" placeholder="retype password" required></label>
			</fieldset>
			<div class="submitContainer"><input name="submit" type="submit" value="Sign Up" class="submitButton"></div>
		</form>	
		
</main>
</body>
</html>