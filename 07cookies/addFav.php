<?php
//check to see if the user is logged in first.
require_once('protect.php');
		
require_once('connectvars.php');
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

?>


<?php include_once('htmlHead.php'); ?>

<body>
<?php include_once('nav.php'); //includes header and nav ?>

<main class="mainContent clearfix">
	<?php
		//checks to see if form was submitted than updates database or else it displays the form.
		if (isset($_POST['submit'])) {
			$favorite = $_POST['favorite'];
			$query = "UPDATE cookie_users SET favorite='$favorite', date=NOW() WHERE username='$_COOKIE[username]'";
			$result = mysqli_query($dbconnection, $query) or die('Query Failed.');
			echo '<p>Menu Item has been added<br><a href="index.php">View top items</a></p>';
			mysqli_close($dbconnection);
			exit();
					
		}
		if (isset($_COOKIE['username'])) {
			$favoriteItem = '';
			//checking if they already have a favorite item
			$query = "SELECT * FROM cookie_users WHERE username='$_COOKIE[username]'";
			$exist = mysqli_query($dbconnection, $query) or die('Select Query failed');
			if (mysqli_num_rows($exist) == 1) {
				$found = mysqli_fetch_array($exist);
				$favoriteItem = $found['favorite'];//if it does add it to the form
				mysqli_close($dbconnection);
			} else {
				//else show a blank form.
				$favoriteItem = '';
			}
		}
	?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="mainForm">
			<fieldset>
				<legend>Favorite Custom Menu Item</legend>
				<label><span class="inputTitle">Favorite Item:</span><textarea class="textInput" name="favorite" placeholder="Whats your favorite custom menu item?"><?php echo $favoriteItem; ?></textarea></label>
			</fieldset>
			<div class="submitContainer"><input name="submit" type="submit" value="Add" class="submitButton"></div>
		</form>	
		
</main>
</body>
</html>