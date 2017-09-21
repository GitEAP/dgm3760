<?php
require_once('authorize.php'); 
require_once('connectvars.php');

$id = $_GET['id'];

//Build db connection
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');
//-------------------IF FORM IS SUBMITTED THEN DELETE THE ROW------------------------
if (isset($_POST['submit'])) {
	//Build query
	$query = "DELETE FROM employee_directory WHERE id=$_POST[id] LIMIT 1";
	
	$result = mysqli_query($dbconnection, $query) or die('Delete Query failed');
	
	//delete image from server
	@unlink($_POST['photo']);
	
	//Redirect
	header("Location: http://dgm3760.erickperezdesign.com/midtermProject/admin.php");
	//make sure code below does not get executed when we redirect
	exit;
};
//-------------------display records------------------------

//Build query
$query = "SELECT * FROM employee_directory WHERE id=$id";

//talk to database
$result = mysqli_query($dbconnection, $query) or die('Query failed');

$found = mysqli_fetch_array($result);

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
	
	<h1>Are you sure you want to delete this employee?</h1>
	
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="mainForm">
		<?php
		echo '<div class="detailContainer clearfix">';
	
		echo '<figure class="detailImg">';
			echo '<img src="images/' . $found['photo'] . '" alt="Picture of employee">';
		echo '</figure>';	
	
		echo '<div class="detailContent">';
		echo '<h3>' . $found['first'] . ' ' .$found['last'] . '</h3>';
		echo '<p>Address: ' . $found['address'] . '</p>';
		echo '<p>Phone: ' . $found['phone'] . '</p>';
		echo '<p>Area: ' . $found['area'] . '</p>';
		echo '<p>Bio:<br>' . $found['bio'] . '</p>';

		echo '<hr>';	
	
?>
		<input type="hidden" name="photo" value="images/<?php echo $found['photo']; ?>">
		<input type="hidden" name="id" value="<?php echo $found['id']; ?>">
		<input type="submit" name="submit" value="DELETE" class="deleteButton">
		<a href="admin.php" class="linkButton">Cancel</a>
		<?php	
			echo '</div>';//end of content

		echo '</div>';//end of container
		?>
		
	</form>
	
	
</main>
<?php include_once('footer.php'); ?>