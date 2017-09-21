<?php
require_once('authorize.php'); 
require_once('connectvars.php');

//Build db connection for inserting (updating) the new information.
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');
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
			if(isset($_POST['submit'])) {
				//then get all the new values and insert them back into the database and display feedback
				$first = $_POST['first'];
				$last = $_POST['last'];
				$address = $_POST['address'];
				$phone = $_POST['phone'];
				$email = $_POST['email'];
				$area = $_POST['expertise'];
				$bio = $_POST['bio'];
				$id = $_POST['id'];//got from the hidden input
								
				//Build query
				$query = "UPDATE employee_directory SET first='$first', last='$last', address='$address', phone='$phone', email='$email', area='$area', bio='$bio' WHERE id=$id";
				//talk to database
				$result = mysqli_query($dbconnection, $query) or die('Query failed');
				
				echo '<h1>Employee successfuly updated</h1>';
				echo '<a href="admin.php" class="linkButton">Back to Admin</a>';

				mysqli_close($dbconnection);
		
			} else {
				//Connect to database to get the info. than show me the form to update the stuff using existing info.
				$id = $_GET['id'];
				//Build db connection
//				$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');
				//Build query
				$query = "SELECT * FROM employee_directory WHERE id=$id";
				//talk to database
				$result = mysqli_query($dbconnection, $query) or die('Query failed...');
				$found = mysqli_fetch_array($result);
				mysqli_close($dbconnection);
	?>
				<h1>Update an employee</h1>
	
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="mainForm">
		<fieldset>
			<legend>Employee Information</legend>
			<input type="text" name="first" value="<?php echo $found['first']; ?>" placeholder="First name" class="userInput" pattern="[a-zA-Z .,-]{2, 99}" title="Enter a first name" required>
			<input type="text" name="last" value="<?php echo $found['last']; ?>" placeholder="Last name" class="userInput" pattern="[a-zA-Z .,-]{2, 99}" title="Enter a last name" required>
			<input type="text" name="address" value="<?php echo $found['address']; ?>" placeholder="Address" class="userInput" pattern="[a-zA-Z .,-]{2, 99}" title="Enter a valid address" required>
			<input type="tel" name="phone" value="<?php echo $found['phone']; ?>" placeholder="Phone ex.123-555-5555" class="userInput" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Enter a valid phone number" required>
			<input type="email" name="email" value="<?php echo $found['email']; ?>" placeholder="Email" class="userInput" title="Enter a valid email address" required>
		</fieldset>
		
		<fieldset>
			<legend>Skills &amp; Expertise</legend>
			<span>Bio:</span>			<span class="charLimit">*Only 160 Characters</span>
			<textarea name="bio" class="bioText" placeholder="Enter bio description here..."><?php echo $found['bio']; ?></textarea>
			
			<span>Area of Expertise</span>
			<select name="expertise" class="expertiseSelect">
				 <option><?php echo $found['area']; ?></option>
				 <option>----------</option>
				 <option>Physics</option>
				 <option>Geography</option>
				 <option>Anthropology</option>
				 <option>Marine Science</option>
				 <option>Earth Science</option>
			</select>
		</fieldset>
		
		<input name="id" value="<?php echo $found['id']; //sends the current id but its hidden(post) ?>" type="hidden">
		<input name="submit" class="submitButton" value="Update Employee" type="submit">
	</form>	
	
		<?php }//end of else
	 ?>
	
</main>
<?php include_once('footer.php'); ?>