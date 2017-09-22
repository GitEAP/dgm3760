<?php 
//check to see if the user is logged in first.
require_once('protect.php');
require_once('connectvars.php');
//get id
$id = $_GET['id'];	
//connect to DB
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM cookie_users WHERE id=$id";
$result = mysqli_query($dbconnection, $query);
$found = mysqli_fetch_array($result);
?>
<?php include_once('htmlHead.php'); ?>

<body>

<?php include_once('nav.php'); //includes header and nav ?>

<main class="mainContent clearfix">

<h1>Favorite Item</h1>

<?php 
	echo '<div class="detailContainer">';
	echo '<p>This item was added by: ' . $found['username'] . '</p>';
	echo '<p>Date added: ' . $found['date'] . '</p>';
	echo '<p>Favorite Item: ' . $found['favorite'] . '</p>';
	echo '</div>';
?>
	
	
</main>
</body>
</html>