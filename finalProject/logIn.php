<?php
require_once('connectvars.php');
$feedback = 'Dont have an account? <a href="signUp.php">Sign Up</a>';
$feedbackStatus = '';

if(isset($_POST['submit'])) {
	//connect to database
	$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');	
	//get variables from form
	$username = mysqli_real_escape_string($dbconnection, trim($_POST['username']));
	$password = mysqli_real_escape_string($dbconnection, trim($_POST['password']));
	//look for the username and password in the table
	$query = "SELECT * FROM final_user WHERE username='$username' AND password= SHA('$password')";
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
		$feedbackStatus = 'feedbackError';
		$feedback = '<p>Could not find an account for ' . $_POST['username'] . '. Would you like to <a href="signUp.php">create an account</a></p>';
	}
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
		
		<h2>Log In</h2>
		
		<div class="<?php echo $feedbackStatus; ?>"><?php echo $feedback; ?></div>
		
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="mainForm">
			<fieldset>
				<label><span>Username:</span><input type="text" name="username" placeholder="Username" class="userInput" value="<?php if(!empty($username)){echo $username;} ?>" required></label>
				<label><span>Password:</span><input type="password" name="password" placeholder="Password" class="userInput" required></label>
			</fieldset>
			<input type="submit" name="submit" value="Log In" class="submitButton">
		</form>

		</section><!--//end of content right			-->
	</div><!--//end of content container-->
</main>
</body>
</html>