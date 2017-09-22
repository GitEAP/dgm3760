<?php include_once('htmlHead.php'); ?>

<body>

<?php include_once('nav.php'); //includes header and nav ?>

<main class="mainContent clearfix">


<h1>All custom menu items</h1>
<p>Do you want to <a href="addFav.php">add a favorite item?</a></p>
<div class="itemsList">
	
<?php 
require_once('connectvars.php');
	
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM cookie_users ORDER BY date";
$result = mysqli_query($dbconnection, $query);
	
while($row = mysqli_fetch_array($result)) {
	
	echo '<p><a href="details.php?id=' . $row['id'] . '">' . $row['favorite'] . '</a> ' . $row['date'] . '</p>';

}
	
	
?>
</div>	
	
	
	
	
	
</main>
</body>
</html>