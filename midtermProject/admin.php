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
		<li><a href="index.php">Employees</a></li>
		<li class="active"><a href="admin.php">Admin</a></li>
	</ul>
</nav>

<div id="top" class="container">

<header class="headerWrapper">
	<i class="fa fa-bars openBtn"></i>
	<h1>Advanced Research Studies<i class="fa fa-flask"></i></h1>
</header>

<main class="mainContent clearfix">
	

<?php 
	echo '<h1>Employees</h1>';
	
	echo '<p>Hiring an employee?</p><a href="add.php" class="linkButton"><i class="fa fa-user-plus"></i> Add Employee</a>';
	
		while ($row = mysqli_fetch_array($result)) {
	
	//Verify the photo exits
	if (file_exists('images/' . $row['photo']) && $row['photo'] <> '') {
		$photoPath = 'images/' . $row['photo'];
	} else {
		$photoPath = 'images/noimagefound.jpg';
	}

	//display all details of employees
		echo '<div class="detailContainer clearfix">';
	
		echo '<figure class="detailImg">';
			echo '<img src="' . $photoPath . '" alt="Picture of employee">';
		echo '</figure>';	
	
		echo '<div class="detailContent">';
		echo '<h3>' . $row['first'] . ' ' .$row['last'] . '</h3>';
		echo '<p>Address: ' . $row['address'] . '</p>';
		echo '<p>Phone: ' . $row['phone'] . '</p>';
		echo '<p>Area: ' . $row['area'] . '</p>';
		echo '<p>Bio:<br>' . $row['bio'] . '</p>';

		echo '<hr>';	
	
		echo '<a href="#" class="linkButton"><i class="fa fa-edit"></i>Update</a>';
		echo '<a href="#" class="deleteButton"><i class="fa fa-trash-o"></i> Delete</a>';
		echo '</div>';//end of content

		echo '</div>';//end of container
		}//end of while loop
?>
	<a href="#top" class="linkButton"><i class="fa fa-hand-o-up"></i> Back to top</a>
</main>
<?php include_once('footer.php'); ?>