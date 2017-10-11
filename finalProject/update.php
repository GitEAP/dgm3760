<?php require_once('authorize.php'); ?>
<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">

	<div class="contentContainer clearfix">

		<aside class="contentLeft">
		<?php include_once('contentLeft.php'); ?>
		</aside>


		<section class="contentRight"> <!-- main page content goes here-->

		<?php
			include_once('connectvars.php');
		
			
			if (isset($_POST['submit'])) {
				$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection Failed');
				
				$id2 = $_POST['id'];
				$title = ucfirst($_POST['title']);
				$rating = $_POST['rating'];
				$star = $_POST['star'];
				$description = mysqli_real_escape_string($dbconnection, ucfirst($_POST['description']));
				
				//update table
				$queryUpdate = "UPDATE final_movie SET title='$title', rating='$rating', stars='$star', description='$description' WHERE id=$id2";
				$result = mysqli_query($dbconnection, $queryUpdate) or die('Update query failed');
	
				echo '<h2>New Changes Saved!</h2>';
				echo '<a href="admin.php" class="linkButton">Back to Admin</a>';

				mysqli_close($dbconnection);
			} else {
				$id = $_GET['id'];
				$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection Failed');
				$query = "SELECT * FROM final_movie WHERE id=$id";
				$result = mysqli_query($dbconnection, $query) or die('Query Failed');
				$found = mysqli_fetch_array($result);
		?>		
		
		<h2>Edit a Movie Review</h2>
		
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="mainForm">
			<fieldset>
				<legend>Movie Information</legend>
				<label><span>Title:</span><input type="text" name="title" placeholder="Whats the name of the movie?" class="userInput" value="<?php echo $found['title'] ?>" required></label>
				
		
				<label><span>MPAA Rating:</span>
				<select name="rating">
					<option><?php echo $found['rating'] ?></option>
					<option>--------</option>
					<option>G</option>
					<option>PG</option>
					<option>PG-13</option>
					<option>R</option>
				</select></label>
			</fieldset>
			
			<fieldset>
				<legend>Review</legend>
				<label><span>Star Rating:</span>
				<select name="star">
					<option><?php echo $found['stars'] ?></option>
					<option>--------</option>
					<option value="1">1 Star</option>
					<option value="2">2 Stars</option>
					<option value="3">3 Stars</option>
					<option value="4">4 Stars</option>
					<option value="5">5 Stars</option>
				</select></label>
								
				<span>Description:</span>
				<textarea name="description" class="formText" placeholder="Write your review..."><?php echo $found['description'] ?></textarea>
			</fieldset>
			<input name="id" value="<?php echo $found['id']; ?>" type="hidden">
			<input type="submit" name="submit" value="Save Changes" class="submitButton">
		</form>
<?php mysqli_close($dbconnection); } ?>
		</section><!--//end of content right			-->
	</div><!--//end of content container-->
</main>
</body>
</html>