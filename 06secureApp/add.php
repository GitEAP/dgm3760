<?php require_once('connectvars.php'); ?>
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
	
<?php
	if (isset($_POST['submit'])) {
		
		$hotelName = $_POST['hotelName'];
		$location = $_POST['location'];
		$phone = $_POST['phone'];
		$rating = $_POST['rating'];
		$photo = $_POST['photo'];

		$newDate = date('Y-m-d');
		$hotelNameNoSp = str_replace(' ','_',"$hotelName");//Removes spaces from the name and replaces with _

		//Make photo path and name
		$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);//returns extension of file
		$filename = $hotelNameNoSp . time() . '.' . $ext;//renames file
		$filepath = '../05manageRecords/images/'; 
		
		//----------------------------------verify image is valid -------------------------------------------
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
			$query = "INSERT INTO hotel_simple (name, location, phone, rating, photo, date)" . "VALUES ('$hotelName', '$location', '$phone', '$rating', '$filename', '$newDate')";

			//talk to database
			$result = mysqli_query($dbconnection, $query) or die('Query failed');

			echo '<h1>Hotel entry has been sent for approval</h1>';
			echo '<p>' . $hotelName . '</p>';
			echo '<img src="' . $filepath . $filename . '" alt="photo">';
			echo '<a href="add.php" class="linkButton">Back</a>';
			
			mysqli_close($dbconnection);

		}else {
			echo '<a href="index.html" class="linkButton">Please try agian.</a>';
		}//end of else
	//----------------------------------END OF VALIDATION -------------------------------------------
		}//end of if (isset(submit))
	else {//else if the form has not been submitted then it displays the form.
?>		
	<h1>Add a Hotel</h1>
	
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="contactForm">
	
		<fieldset>
			<legend>General Information</legend>
			
			<label><span>Hotel Name:</span><input name="hotelName" type="text" placeholder="Castle Inn" pattern="[a-zA-Z -.,'/0-9]{3,999}"  class="userInput" required></label>
			<label><span>Location:</span><input name="location" type="text" placeholder="City, State" pattern="[a-zA-Z -.,'/0-9]{3,999}" class="userInput" required></label>
			<label><span>Phone:</span><input name="phone" type="tel" placeholder="123-555-9876"  class="userInput" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required></label>
		</fieldset>
		
		<fieldset>
			<legend>Rating</legend>
			
			<label><span>Please Select:</span>
			<select name="rating">
				<option>1 Star</option>
				<option>2 Star</option>
				<option>3 Star</option>
				<option>4 Star</option>
				<option>5 Star</option>
			</select>
			</label>
		</fieldset>
		
		<fieldset>
			<legend>Photo</legend>
			
			<label>
			<span>Upload photo of hotel:</span>
			<input name="photo" type="file"><br>
			<span>File must be saved as a .jpg file.</span>
			<span>Please crop to 300px x 200px, before uploading.</span>
			</label>
		</fieldset>
	
	<input class="submitbutton" name="submitbutton" value="Add Hotel" type="submit">
	</form>
	
		<?php
		 }//end of else of isset(submit)
?>
	
</main>

<?php include_once('footer.php'); ?>