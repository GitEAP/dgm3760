<?php
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
	}
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
		
	<h2>All Movie Reviews</h2>
	
		<?php			
			include_once('connectvars.php');
			$filepath = 'images/';
			$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection Failed');
			$query = "SELECT * FROM final_movie ORDER BY title";
			$result = mysqli_query($dbconnection, $query) or die('Query failed');
			while ($row = mysqli_fetch_array($result)) {
				//display records title/photo/rating/stars/description
				echo '<div class="contentRecord clearfix">';
				
				echo '<div class="RecordColumn1">';
				echo '<img src="'. $filepath.$row['photo'] .'" alt="' . $row['title'] . ' Movie Poster">';
				echo '</div>';//end of reocrdColumn
				
				echo '<div class="RecordColumn2">';
				
				echo '<h3>'.$row['title'].'</h3>';
				
				echo '<span>Rated: '.$row['rating'].' | Review Score: '. numStars($row['stars']) .' / 5 Stars</span>';
				echo '<p>'. substr($row['description'],0,300) .'..... <a href="details.php?id='.$row['id'].'">View Details</a></p>';
					
				echo '</div>';//end of record column
				echo '</div>';//end of contentRecord
			}
		mysqli_close($dbconnection);
		?>		
		<a href="#top"><i class="fa fa-caret-up"></i> Back to Top</a>
		</section><!--//end of content right			-->
	
	</div><!--//end of content container-->
</main>

</body>
</html>