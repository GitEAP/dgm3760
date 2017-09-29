<?php
require_once('connectvars.php');
//connect to database
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection Failed');
//Get data from movie_fav table
$query = "SELECT * FROM movie_fav";
$resultFav = mysqli_query($dbconnection, $query) or die('Select Query failed.');
//Get data from movie_genre table
$query = "SELECT * FROM movie_genre ORDER BY name";
$resultGenre = mysqli_query($dbconnection, $query) or die('Genre query failed');

?>


<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">
	
	<h1>Add a New User</h1>

	
	<form action="addToDB.php" method="POST" enctype="multipart/form-data" class="mainForm">
		
		<fieldset>
			<legend>Personal Information</legend>
			<input name="first" type="text" placeholder="First Name" pattern="[a-zA-Z .,/-]{2,99}" required class="userInput">
			<input name="last" type="text" placeholder="Last Name" pattern="[a-zA-Z .,/-]{2,99}" required class="userInput">
			<input name="email" type="email" placeholder="email@email.com" required class="userInput">
		</fieldset>
		
		<fieldset>
			<legend>Expertise</legend>
			<label><span>How well do you know your movies?</span></label>
			<label><input type="radio" name="expertise" value="1">Novice</label>
			<label><input type="radio" name="expertise" value="2">Expert</label>
		</fieldset>
		
		<fieldset>
			<legend>Favorite</legend>
			<label><span>Favorite movie of 2017?</span></label>
			<select name="favorite" class="selectInput">
				<option>Please Select...</option>
		<?php 
			while ($row = mysqli_fetch_array($resultFav)) {
				echo '<option value="' . $row['fav_id'] . '">' . $row['name'] . '</option>';
			}		
		?>
			</select>
		</fieldset>
		
	
		<fieldset>
			<legend>Genres</legend>
			<span>Choose all of your favorite Genres?</span>
			<?php
			while($row = mysqli_fetch_array($resultGenre)) {
				echo '<label class="checks"><input type="checkbox" value="' . $row['id'] . '" name="genres[]">' . $row['name'] . '</label>';
			}
			?>
		</fieldset>
		
		
		<input name="submit" value="Add User" type="submit" class="submitButton">
	</form>
	
	
	
</main>
<?php include_once('footer.php'); ?>