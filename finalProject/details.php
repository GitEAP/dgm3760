<?php 
require_once('connectvars.php');
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection Failed');
$filepath = 'images/';
$movie_id = $_GET['id'];

function numStars ($stars) {
	$string = '';
	for ($i = 1; $i <= 5; $i++) {

		if ($i <= $stars) {
			$string .= '<i class="fa fa-star"></i>';
		}
		else {
			$string .= '<i class="fa fa-star-o"></i>';
		}//end of if else
	}//end of for loop		
	return $string;
}//end of function
?>



<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix" id="#top">

	<div class="contentContainer clearfix">

		<aside class="contentLeft">
		<?php include_once('contentLeft.php'); ?>
		</aside>

		<section class="contentRight">

		<?php			

			$query = "SELECT * FROM final_movie WHERE id=$movie_id";
			$result = mysqli_query($dbconnection, $query) or die('Query failed');
			$found = mysqli_fetch_array($result);

			echo '<h2>'.$found['title'].' Review</h2>';
			
			//display Movie Details
			echo '<div class="contentRecord clearfix">';

			echo '<div class="RecordColumn1">';
			echo '<img src="'. $filepath.$found['photo'] .'" alt="' . $found['title'] . ' Movie Poster">';
			echo '</div>';//end of reocrdColumn

			echo '<div class="RecordColumn2">';

			echo '<h3>'.$found['title'].'</h3>';

			echo '<span>Rated: '.$found['rating'].' | Review Score: '. numStars($found['stars']) .' / 5 Stars</span>';
			echo '<p>'. $found['description'] .'</p>';

			echo '</div>';//end of record column
			echo '</div>';//end of contentRecord
		
		//tells user to sign in to add a comment and if sign in show form to add comment.
		if (!isset($_COOKIE['username'])) {
			echo '<p><a href="logIn.php">Sign in</a> to add a comment</p><br>';
		} else {	
?>
	<form action="addComment.php" method="POST" enctype="multipart/form-data" class="commentForm">
		<fieldset>
			<legend>Add a Comment</legend>
				<span>Comment:</span>
				<textarea name="comment" class="formText" placeholder="Write your comment..."></textarea>
		
				<label><span>Star Rating:</span>
				<select name="star">
					<option value="1">1 Star</option>
					<option value="2">2 Stars</option>
					<option value="3">3 Stars</option>
					<option value="4">4 Stars</option>
					<option value="5">5 Stars</option>
				</select></label>
		</fieldset>
		<input type="hidden" name="movieID" value="<?php echo $_GET['id']; ?>">
		<input type="submit" name="submit" value="Add Comment" class="submitButton">
	</form>	
	<?php }//end of if else ?>
			
																	
<?php
				//DISPLAY ALL COMMENTS			
			$queryCommentJoins = "SELECT * FROM ((final_comments INNER JOIN final_movie ON final_comments.movie_id = final_movie.id) INNER JOIN final_user ON final_comments.user_id = final_user.user_id) WHERE movie_id=$movie_id ORDER BY date DESC";
			
			$resultComments = mysqli_query($dbconnection, $queryCommentJoins) or die('Comment Query failed');

			if (mysqli_num_rows($resultComments) > 0) {
				while ($row = mysqli_fetch_array($resultComments)) {
					echo '<div class="contentRecord clearfix">';
					//show username who added a comment
					//show rating given by user
					echo '<div class="contentComment">';
					echo '<h3>';
					echo $row['username'] . '<span> scored this movie ' . numStars($row['user_stars']) . ' / 5 stars | Added on '.$row['date'].'</span>';
					echo '</h3>';
					
					//show comment
					echo '<p>'. $row['comment']. '</p>';
					echo '</div>';//end of content comment
					echo '</div>';//end of contentRecord
				}//end of while loop
			} else {
				echo '<p>No comments added yet.</p><br>';
			}//end of if else
			
		mysqli_close($dbconnection);
		?>	
		
		<a href="#top"><i class="fa fa-caret-up"></i> Back to Top</a>
		</section><!--//end of content right			-->
	
	</div><!--//end of content container-->
</main>

</body>
</html>