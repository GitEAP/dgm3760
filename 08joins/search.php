<?php
require_once('connectvars.php');
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');

$query = "SELECT * FROM movie_fav ORDER BY name";
$result = mysqli_query($dbconnection, $query) or die('Query failed');
?>
<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">
	
	<h1>Search Users</h1>
	
	<h2>Search by Favorite Movie of 2017</h2>
	<ul class="searchList clearfix">
		<?php
			while($row = mysqli_fetch_array($result)) {
				echo '<li><a href="index.php?favorite=' . $row['fav_id'] . '">' . $row['name'] . '</a></li>';
			}
			
		?>
	</ul>

</main>
<?php mysqli_close($dbconnection); ?>
<?php include_once('footer.php'); ?>