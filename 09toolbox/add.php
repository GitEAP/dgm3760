<?php
require_once('connectvars.php');

	if(isset($_POST['submit'])) {
		//Get variables from the form
		$title = ucfirst($_POST['title']);
		$director = ucwords($_POST['director']);
		$rating = strtoupper($_POST['rating']);
		$day = $_POST['day'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		$movieDay = $day.'_'.$month.'_'.$year;
		//Connect to DB to add variables
		$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');
	
		$summary = mysqli_real_escape_string($dbconnection, ucfirst($_POST['summary']));
		
		$query = "INSERT INTO watch_movie (title, director, movie_day, summary, rating)" .
			"VALUES ('$title', '$director', '$movieDay', '$summary', '$rating')";	

		$result = mysqli_query($dbconnection, $query) or die('Query failed');
	
		mysqli_close($dbconnection);
		header('Location: index.php');
		exit;
	}
?>
<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">
	
	<h1>Add a Movie Entry</h1>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="mainForm">
		<fieldset>
			<legend>Movie Information</legend>
			<input type="text" name="title" class="userInput" placeholder="What's the Movies Name" required>
			<input type="text" name="director" class="userInput" placeholder="What's the Directors Name" required>
			<input type="text" name="rating" class="userInput" placeholder="Enter the Motion Picture Rating ex. PG" required>
			
			<label><span>Movie Release date:</span></label><br>
			
			<span class="releaseDate">Day:</span>
			<select name="day" class="releaseDateSelect">
				<?php 
					for($i=1; $i <= 31; $i++) {
						echo ($i < 10 ? '<option>0' . $i . '</option>' : '<option>' . $i . '</option>');
					}			
				?>
			</select>
			
			<span class="releaseDate">Month:</span>
			<select name="month" class="releaseDateSelect">
				<?php 
					for($i=1; $i <= 12; $i++) {
						echo ($i < 10 ? '<option>0' . $i . '</option>' : '<option>' . $i . '</option>');
					}
				?>
			</select>
						
				<span class="releaseDate">Year:</span>
			<select name="year" class="releaseDateSelect">
				<?php
					for($i=2017; $i >= 1920; $i--) {
						echo '<option>'.$i.'</option>';
					}
				?>
			</select>
			
			<textarea name="summary" class="bioText" placeholder="What is the movie about?"></textarea>	
					
		</fieldset>
		<input type="submit" name="submit" value="Add Movie" class="submitButton">
	</form>

</main>
<?php include_once('footer.php'); ?>