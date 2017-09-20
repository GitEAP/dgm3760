<?php require_once('connectvars.php'); 
$id = $_GET['id'];

$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');
$query = "SELECT * FROM employee_directory WHERE id=$id";
$result = mysqli_query($dbconnection, $query);
$found = mysqli_fetch_array($result);
?>
<?php include_once('htmlHead.php'); ?>
<body>

<nav class="mainNav" id="mainSideNav">
	<ul>
		<li><a href="javascript:void(0)" class="fa fa-close closeBtn"></a></li>
		<li><a href="index.php">Employees</a></li>
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
	

<?php 
	
		echo '<h1>Meet ' . $found['first'] . '</h1>';
	
	//Verify the photo exits
	if (file_exists('images/' . $found['photo']) && $found['photo'] <> '') {
		$photoPath = 'images/' . $found['photo'];
	} else {
		$photoPath = 'images/noimagefound.jpg';
	}

	//display all details of employees
		echo '<div class="detailContainer clearfix">';
	
		echo '<figure class="detailImg">';
			echo '<img src="' . $photoPath . '" alt="Picture of employee">';
		echo '</figure>';	
	
		echo '<div class="detailContent">';
		echo '<h3>' . $found['first'] . ' ' .$found['last'] . '</h3>';
		echo '<p>Address: ' . $found['address'] . '</p>';
		echo '<p>Phone: ' . $found['phone'] . '</p>';
		echo '<p>Area: ' . $found['area'] . '</p>';
		echo '<p>Bio:<br>' . $found['bio'] . '</p>';

		echo '<hr>';	
	
		echo '<a href="#" class="linkButton">Email Me</a>';
		echo '<a href="index.php" class="linkButton">Back</a>';
		echo '</div>';

		echo '</div>';
?>
	
</main>
<?php include_once('footer.php'); ?>