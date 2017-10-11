<?php
require_once('connectvars.php');
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection Failed');

if (isset($_POST['submit'])){
	$star = $_POST['star'];
	$comment = mysqli_real_escape_string($dbconnection, $_POST['comment']);
	$currentMovieId = $_POST['movieID'];
	
	//Get id of user
	$queryGetUser = "SELECT * FROM final_user WHERE username='$_COOKIE[username]' AND first='$_COOKIE[firstname]'";

	$result2 = mysqli_query($dbconnection, $queryGetUser) or die('Get user query failed.');
	$foundUser = mysqli_fetch_array($result2);

	//use user id and movie id to Insert into comment table
	$queryInsertComment = "INSERT INTO final_comments (user_id, movie_id, user_stars, comment, date) VALUES('$foundUser[user_id]','$currentMovieId','$star','$comment', NOW())";

	$insertResult = mysqli_query($dbconnection, $queryInsertComment) or die('Insert comment failed.');
	
	header("Location: details.php?id=$currentMovieId");
	
}
else {
	echo 'Something Went Wrong. Try again';
	echo '<a href="details.php?id='.$_POST['movieID'].'">Back</a>';
}
?>