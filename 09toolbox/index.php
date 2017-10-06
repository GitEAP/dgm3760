<?php
require_once('connectvars.php');
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');

$query = "SELECT * FROM watch_movie ORDER BY title";
$result = mysqli_query($dbconnection, $query) or die('select query failed');

function convertMonth($monthNum) {
	
	switch ($monthNum) {
		case 1:
			$monthName = 'January';
			break;
	
		case 2:	
			$monthName = 'February';
			break;
			
		case 3:
			$monthName = 'March';
			break;
	
		case 4:	
			$monthName = 'April';
			break;
				
		case 5:
			$monthName = 'May';
			break;
	
		case 6:	
			$monthName = 'June';
			break;
				
		case 7:
			$monthName = 'July';
			break;
	
		case 8:	
			$monthName = 'August';
			break;
				
		case 9:
			$monthName = 'September';
			break;
	
		case 10:	
			$monthName = 'October';
			break;
			
		case 11:
			$monthName = 'November';
			break;
	
		case 12:	
			$monthName = 'December';
			break;
	}//end of switch
	return $monthName;
}//end of function

?>
<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">

<h1>Movies to Watch</h1>

<?php	
while($row = mysqli_fetch_array($result)) {
	
	$viewDateDay = substr($row['movie_day'],0,2);//gets the day number
	$getMonthNum = substr($row['movie_day'],3,2);//gets the month number
	$viewDateMonth = convertMonth($getMonthNum);//converts month number to the month name
	$viewDateYear = substr($row['movie_day'],6,4);//gets the year
	$viewDate = $viewDateMonth . ' ' . $viewDateDay . ', ' . $viewDateYear;//makes the right string date
	//Display Results
	echo '<div class="detailContainer clearfix" id="'.$row['title'].'">';
	echo '<div class="detailContent">';
			echo '<h3>' . $row['title'] . '</h3>';
			echo '<p>Director: ' . $row['director'] . '</p>';
			echo '<p>Released on: ' . $viewDate . '</p>';
			echo '<p>Rated: ' . $row['rating'] . '</p>';
			echo '<p>Plot Summary:<br>' . $row['summary'] . '</p>';
	echo '</div>';//end of content
	echo '</div>';//end of container
}
?>
	
	

</main>
<?php mysqli_close($dbconnection); ?>
<?php include_once('footer.php'); ?>