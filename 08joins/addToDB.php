<?php
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$expertise = $_POST['expertise'];
$favorite = $_POST['favorite'];

require_once('connectvars.php');
//connect to database
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection Failed');
//Get data from movie_fav table
$query = "INSERT INTO movie_user (first, last, email, expertise, favorite) VALUES ('$first','$last','$email','$expertise', '$favorite')";

$result = mysqli_query($dbconnection, $query) or die('Query failed.');

//--------------------------UPDATE SELECTED GENRES -----------------------
//get id of the new user
$recent_id = mysqli_insert_id($dbconnection);

//loop through the array that contains all the selected genres and INSERT in movie_response
foreach($_POST['genres'] as $genre_id) {
	$genreQuery = "INSERT INTO movie_response (user, genre) VALUES ($recent_id, $genre_id)";
	$result = mysqli_query($dbconnection, $genreQuery) or die('Genre query failed.');
}
mysqli_close($dbconnection);

?>

<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">
	
	<h1><?php echo $first. ' '. $last; ?> has been added</h1>

	<a href="add.php" class="linkButton">Add Another User</a>
	<a href="index.php" class="linkButton">Return to Home Page</a>

	
</main>
<?php include_once('footer.php'); ?>