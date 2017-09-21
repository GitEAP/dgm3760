<?php
require_once('authorize.php'); 
require_once('connectvars.php');

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

<div class="container">

<header class="headerWrapper">
	<i class="fa fa-bars openBtn"></i>
	<h1>Advanced Research Studies<i class="fa fa-flask"></i></h1>
</header>

<main class="mainContent">
	<?php
		if (isset($_POST['submit'])) {//if the form was submitted do this
		//get variables
		$first = $_POST['first'];
		$last = $_POST['last'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$area = $_POST['expertise'];
		$bio = $_POST['bio'];
		$photo = $_POST['photo'];
		//change photo name and get a photo path.
		$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);//returns extension of file
		$filename = $first . $last . time() . '.' . $ext;//renames file
		$filepath = 'images/'; 
		
//---------------------------------- VERIFY THE IMAGE IS VALID -------------------------------------------
		$validImage = true;
		//check image is missing
		if ($_FILES['photo']['size'] == 0) {
			echo '<h1>Oops, you did not select an image!</h1>';
			$validImage = false;
		};
		//check image is too large
		if ($_FILES['photo']['size'] > 204800) {
			echo '<h1>Oops, That file was larger than 200KB.</h1>';
			$validImage = false;
		};
		//check file type or format
		if ($_FILES['photo']['type'] == 'image/gif' || $_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/pjpeg' || $_FILES['photo']['type'] == 'image/png'){
			//everything is good.
		} else {
			//not correct
			echo '<h1>Oops, That file is the wrong format.</h1>';
			$validImage = false;
		};
	//---------------------if the image is valid -------------------
		if ($validImage == true) {
			//upload file and moving it to the images folder on server than deleting the temp location.
			$tmp_name = $_FILES['photo']['tmp_name'];
			move_uploaded_file($tmp_name, $filepath.$filename);//moves file from temp to new folder
			@unlink($_FILES['photo']['tmp_name']);//deletes temp file

			//Build db connection
			$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');
			//Build query
			$query = "INSERT INTO employee_directory (first, last, address, phone, email, area, bio, photo)" . "VALUES ('$first', '$last', '$address', '$phone', '$email', '$area', '$bio', '$filename')";

			//talk to database
			$result = mysqli_query($dbconnection, $query) or die('Query failed');

			echo '<h1>' . $first . ' ' . $last . ' has been added to employees</h1>';
			echo '<img src="' . $filepath . $filename . '" alt="photo">';
			echo '<a href="admin.php" class="linkButton">Back to Admin</a>';
			echo '<a href="add.php" class="linkButton">Add More</a>';

			mysqli_close($dbconnection);

		}else {
			echo '<a href="add.php" class="linkButton">Please try agian</a>';
		}//end of if-else validimage is true.			
//---------------------------------------END OF VALIDATION------------------------------------------------
		} else {//if the form has not been submitted do this...
	?>
	<h1>Add a new employee</h1>
	
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="mainForm">
		<fieldset>
			<legend>Employee Information</legend>
			<input type="text" name="first" placeholder="First Name" class="userInput" pattern="[a-zA-Z .,-]{2, 99}" title="Enter a first name" required>
			<input type="text" name="last" placeholder="Last Name" class="userInput" pattern="[a-zA-Z .,-]{2, 99}" title="Enter a last name" required>
			<input type="text" name="address" placeholder="Address" class="userInput" pattern="[a-zA-Z .,-]{2, 99}" title="Enter a valid address" required>
			<input type="tel" name="phone" placeholder="Phone ex.123-555-5555" class="userInput" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Enter a valid phone number" required>
			<input type="email" name="email" placeholder="Email" class="userInput" title="Enter a valid email address" required>
		</fieldset>
		
		<fieldset>
			<legend>Skills &amp; Expertise</legend>
			<span>Bio:</span>			<span class="charLimit">*Only 160 Characters</span>
			<textarea name="bio" class="bioText" placeholder="Enter bio description here..."></textarea>

			
			<span>Area of Expertise</span>
			<select name="expertise" class="expertiseSelect">
				 <option>Physics</option>
				 <option>Geography</option>
				 <option>Anthropology</option>
				 <option>Marine Science</option>
				 <option>Earth Science</option>
			</select>
		</fieldset>
		
		<fieldset>
			<legend>Upload employee picture</legend>
			<label>
			<input name="photo" type="file" class="uploadButton"><br>
			<span>File must be saved as a .jpg file.</span><br>
			<span>Please crop to 300px x 300px, before uploading.</span>
			</label>
		</fieldset>
		
		<input name="submit" class="submitButton" value="Add Employee" type="submit">
	</form>
	
	<?php }//end of else ?>
	
</main>
<?php include_once('footer.php'); ?>