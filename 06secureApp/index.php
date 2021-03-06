<?php
require_once('connectvars.php');
//Build db connection
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');
//Build query
$query = "SELECT * FROM hotel_simple WHERE approved=1 ORDER BY date";
//talk to database
$result = mysqli_query($dbconnection, $query) or die('Query failed');
?>

<?php include_once('htmlHead.php'); ?>

<body>

<div class="headerWrapper clearfix">
	<h1>Travel Hotel</h1>
</div>

<div class="nav clearfix">
	<ul>
		<li class="active"><a href="index.php">View</a></li>
		<li><a href="add.php">Add</a></li>
		<li><a href="admin.php">Admin</a></li>
	</ul>
</div>

<main class="containerContent clearfix">
	<h1>View Hotels</h1>
	
	<?php
//Display table data
while ($row = mysqli_fetch_array($result)) {
	//Checks to see the images exists or else it displays a default images.
	if (file_exists('../05manageRecords/images/' . $row['photo']) && $row['photo'] <> '') {
	$photoPath = '../05manageRecords/images/' . $row['photo'];
	} else {
		$photoPath = 'images/noimagefound.jpg';
	}
	//Displays the information
	echo '<div class="clearfix">';
	echo '<div class="detailPicContainer">';
	echo '<img src="' . $photoPath . '" alt="Photo of Hotel">';
	echo '</div>';
	
	echo '<div class="detailContainer">';
	echo '<h2>' . $row['name'] . '</h2>';
	echo '<p>' . $row['location'] . '</p>';
	echo '<p>' . $row['phone'] . '</p>';
	echo '<p>' . $row['rating'] . '</p>';
	echo '</div>';
	echo '</div>';
}//end of while loop
	
mysqli_close($dbconnection);
?>
		
</main>

<?php include_once('footer.php'); ?>