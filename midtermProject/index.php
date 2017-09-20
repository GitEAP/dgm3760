<?php require_once('connectvars.php'); 

$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');
$query = "SELECT * FROM employee_directory";
$result = mysqli_query($dbconnection, $query);
?>
<?php include_once('htmlHead.php'); ?>
<body>

<nav class="mainNav" id="mainSideNav">
	<ul>
		<li><a href="javascript:void(0)" class="fa fa-close closeBtn"></a></li>
		<li class="active"><a href="index.php">Employees</a></li>
		<li><a href="admin.php">Admin</a></li>
	</ul>
</nav>

<div class="container">

<header class="headerWrapper">
	<i class="fa fa-bars openBtn"></i>
	<h1>Advanced Research Studies<i class="fa fa-flask"></i></h1>
</header>

	<div class="banner"></div>

<main class="mainContent clearfix">
	
	<h1>Research Team</h1>
	<div class="row clearfix">
<?php 
	//display all hired employees
	while ($row = mysqli_fetch_array($result)) {	
	
		echo '<div class="column">';
		echo '<figure>';
			echo '<img src="images/' . $row['photo'] . '" alt="Picture of employee">';
		
				echo '<figcaption class="masterCaption">';
				echo '<h3>' . $row['first'] . ' ' .$row['last'] . '</h3>';
				echo '<h4>' . $row['area'] . '</h4>';
				echo '<a href="detail.php?' . $row['id'] . '" class="detailButton">View Details</a>';
				echo '</figcaption>';
		echo '</figure>';	
		echo '</div>';
}//end of while loop
?>
	</div><!--end of row-->
	
</main>
<?php include_once('footer.php'); ?>