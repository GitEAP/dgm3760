<?php
require_once('connectvars.php');

$hotelName = $_POST['hotelName'];
$location = $_POST['location'];
$phone = $_POST['phone'];
$rating = $_POST['rating'];
$photo = $_POST['photo'];

$hotelNameNoSp = str_replace(' ','_',"$hotelName");//Removes spaces from the name and replaces with _

//Make photo path and name
$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);//returns extension of file
$filename = $hotelNameNoSp . time() . '.' . $ext;//renames file
$filepath = '../05manageRecords/images/'; 


//------------------verify image is valid ------------------
$validImage = true;
//check image is missing
if ($_FILES['photo']['size'] == 0) {
	echo 'Oops, you did not select an image!';
	$validImage = false;
};
//check image is too large
if ($_FILES['photo']['size'] > 204800) {
	echo 'Oops, That file was larger than 200KB.';
	$validImage = false;
};
//check file type
if ($_FILES['photo']['type'] == 'image/gif' || $_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/pjpeg' || $_FILES['photo']['type'] == 'image/png'){
	//everything is good.
} else {
	//not correct
	echo 'Oops, That file is the wrong format.';
	$validImage = false;
};

//---------------------if the image is valid -------------------
if ($validImage == true) {
	//upload file
	$tmp_name = $_FILES['photo']['tmp_name'];
	move_uploaded_file($tmp_name, $filepath.$filename);//moves file from temp to new folder
	@unlink($_FILES['photo']['tmp_name']);//deletes temp file
	
	
	//Build db connection
	$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');
	//Build query
	$query = "INSERT INTO hotel_simple (name, location, phone, rating, photo)" . "VALUES ('$hotelName', '$location', '$phone', '$rating', '$filename')";

	//talk to database
	$result = mysqli_query($dbconnection, $query) or die('Query failed');

	mysqli_close($dbconnection);
	
	
}else {
	echo '<a href="index.html" class="linkButton">Please try agian.</a>';
};
?>

<?php include_once('htmlHead.php'); ?>

<body>

<div class="headerWrapper clearfix">
	<h1>Travel Hotel</h1>
</div>

<div class="nav clearfix">
	<ul>
		<li><a href="index.php">View</a></li>
		<li class="active"><a href="add.php">Add</a></li>
		<li><a href="admin.php">Admin</a></li>
	</ul>
</div>

<main class="containerContent">
	<h1>Hotel entry has been sent for approval</h1>
<?php
	echo '<p>' . $hotelName . '</p>';
	echo '<img src="' . $filepath . $filename . '" alt="photo">';
	echo '<a href="add.php" class="linkButton">Back</a>';
?>

</main>

<?php 
	mysqli_close($dbconnection);
	include_once('footer.php'); ?>