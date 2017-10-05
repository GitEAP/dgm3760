<?php
require_once('connectvars.php');
//$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');
//
//$query = "SELECT * FROM movie_user INNER JOIN movie_fav ON (movie_user.favorite = movie_fav.fav_id) $queryWhere ORDER BY last";
//$result = mysqli_query($dbconnection, $query) or die('inner join failed');

?>
<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">
	
	
	
	
	
	
	
	

</main>
<?php mysqli_close($dbconnection); ?>
<?php include_once('footer.php'); ?>