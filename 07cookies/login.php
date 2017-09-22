<?php
require_once('connectvars.php');

$feedback = '<a href="signUp.php">Create an account</a>';

	if(isset($_POST['submit'])) {
		//connect to database
		$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');	
		//get variables from form
		$user_username = mysqli_real_escape_string($dbconnection, trim($_POST['userName']));
		$user_password = mysqli_real_escape_string($dbconnection, trim($_POST['passWord']));
		//look for the username and password in the table
		$query = "SELECT * FROM cookie_users WHERE username='$user_username' AND password= SHA('$user_password')";
		$data = mysqli_query($dbconnection, $query) or die('query failed.');
		//if found, log in.
		if (mysqli_num_rows($data) == 1) {
			//get the data from table
			$row = mysqli_fetch_array($data);
			//make cookies
			setcookie('username', $row['username'], time() + (60*60*24*30));
			setcookie('firstname', $row['first'], time() + (60*60*24*30));
			setcookie('lastname', $row['last'], time() + (60*60*24*30));

			mysqli_close($dbconnection);
			header('Location: index.php');
			
		}else {
			$feedback = '<p>Could not find an account for ' . $_POST['userName'] . '. Would you like to <a href="signUp.php">create an account</a></p>';
		}
	}
?>
<?php include_once('htmlHead.php'); ?>

<body>

<?php include_once('nav.php'); //includes header and nav ?>


<main class="mainContent clearfix">
	<?php echo $feedback; ?>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="mainForm">
			<fieldset>
				<legend>Log In</legend>
				<label><span class="inputTitle">Username:</span><input class="userInput" name="userName" value="<?php if(!empty($user_username)) {echo $user_username;} ?>" type="text" placeholder="username"></label>
				<label><span class="inputTitle">Password:</span><input class="userInput" name="passWord" type="password" placeholder="password"></label>
			</fieldset>
			<div class="submitContainer"><input name="submit" type="submit" value="Log In" class="submitButton">
				<div class="cancelContainer"><a href="index.php">Cancel</a></div>
			</div>
		</form>
</main>
</body>
</html>