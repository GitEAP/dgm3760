<?php
require_once('connectvars.php');
//Get variables from form.
$title = ucfirst($_POST['title']);
$rating = $_POST['rating'];
$star = $_POST['star'];
$photo = $_POST['photo'];
//***************move picture from temp to images folder***************
//change photo name and get a photo path.
	$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);//returns extension of file
	$title_NoSp = str_replace(' ','_',"$title");//Removes spaces from the name and replaces with _
	$filename = $title_NoSp . time() . '.' . $ext;//renames file
	$filepath = 'images/'; 
//***************validate picture file***************
function validImage($image) {
	//check image is missing
	if ($_FILES['photo']['size'] == 0) {
		echo '<h1>Oops, you did not select an image!</h1>';
		$image = false;
	};
	//check image is too large
	if ($_FILES['photo']['size'] > 204800) {
		echo '<h1>Oops, That file was larger than 200KB.</h1>';
		$image = false;
	};
	//check file type or format
	if ($_FILES['photo']['type'] == 'image/gif' || $_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/pjpeg' || $_FILES['photo']['type'] == 'image/png'){
		//everything is good.
	} else {
		//not correct
		echo '<h1>Oops, That file is the wrong format.</h1>';
		$image = false;
	};
	return($image);
}//end of valid image function
//******************add to DB if it's valid***************
function addImage($image) {
	if ($image == true) {
		//Build db connection
		$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');

		//escape variables for security
		$description = mysqli_real_escape_string($dbconnection, ucfirst($_POST['description']));
		//Get other variables
		global $title, $rating, $star,$filepath, $filename;
		
		//upload file and moving it to the images folder on server than deleting the temp location.
		$tmp_name = $_FILES['photo']['tmp_name'];
		move_uploaded_file($tmp_name, $filepath.$filename);//moves file from temp to new folder
		@unlink($_FILES['photo']['tmp_name']);//deletes temp file		

		//Build query
		$query = "INSERT INTO final_movie (title, rating, stars, description, photo)" . "VALUES ('$title', '$rating', '$star', '$description', '$filename')";
		
		//talk to database
		$result = mysqli_query($dbconnection, $query) or die('Query failed');
		//close connection
		mysqli_close($dbconnection);
	}else {
		echo '<a href="add.php" class="linkButton">Please try agian</a>';
		exit();
	}//end of if-else validimage is true.
	return $image;
}//end of addImage function
?>

<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">

	<div class="contentContainer clearfix">

		<aside class="contentLeft">
		<?php include_once('contentLeft.php'); ?>
		</aside>

		<section class="contentRight"> <!-- main page content goes here-->
<?php
	$validImage = true;
	validImage($validImage);
	addImage($validImage);
?>
		<h2>Movie Review has been Added</h2>
		<a href="add.php">Add another movie?</a>

		</section><!--//end of content right			-->
	</div><!--//end of content container-->
</main>
</body>
</html>