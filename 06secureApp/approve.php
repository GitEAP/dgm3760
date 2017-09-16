<?php
require_once('connectvars.php');

//Build db connection
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');
//Build query
$query = "SELECT * FROM hotel_simple WHERE approved=0 ORDER BY date";

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
		<li><a href="index.php">View</a></li>
		<li><a href="add.php">Add</a></li>
		<li class="active"><a href="admin.php">Admin</a></li>
	</ul>
</div>

<main class="ContentContact">
<h1>Delete Hotel</h1>

<?php
	
while ($row = mysqli_fetch_array($result)) {
	echo '<p class="deleteList">';
	echo $row['name'] . ' - ' . $row['location'];
	echo '<a href="deleteconfirm.php?id=' . $row['id'] . '" class="linkButton">delete</a>';
	echo '</p>';
}
	
mysqli_close($dbconnection);
?>



</main>


<footer>
	<p>&copy; 2017 &bull; Erick Perez &bull; Built for DGM 3760 Web Languages 2</p>
</footer>

</body>
</html>
