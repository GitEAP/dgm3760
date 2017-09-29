<?php
require_once('connectvars.php');
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');

$query = "SELECT * FROM movie_user INNER JOIN movie_fav ON (movie_user.favorite = movie_fav.fav_id) ORDER BY last";
$result = mysqli_query($dbconnection, $query) or die('inner join failed');

?>


<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">
	
	<h1>All Users</h1>
	
	<?php
		while($row = mysqli_fetch_array($result)) {
	
			echo '<div class="detailContainer clearfix">';
			echo '<div class="detailContent">';
					echo '<h3>' . $row['first'] . ' ' . $row['last'] . '</h3>';
					echo '<p>' . $row['first'] . ' is a ' . ($row['expertise'] == 1 ? 'Novice' : 'Expert') . ' movie watcher. Favorite movie of 2017 is: ' . $row['name'] . '</p>';
			
			$the_id = $row['id'];
			
			echo '<p>Favorite movie genres are:</p>';
			//another inner join
			$query2 = "SELECT * FROM movie_response INNER JOIN movie_genre ON (movie_response.genre = movie_genre.id) WHERE user=$the_id";
			
			$resultGenre = mysqli_query($dbconnection, $query2) or die('genre query failed');
			
			echo '<div class="movieList">';
			while($row2 = mysqli_fetch_array($resultGenre)) {
				echo '<p>' . $row2['name'] . '</p>';
			}//end of inner while
			echo '</div>';//end of movielist

			echo '</div>';//end of content
			echo '</div>';//end of container
		}//end of while
	?>

	
	
</main>
<?php mysqli_close($dbconnection); ?>
<?php include_once('footer.php'); ?>