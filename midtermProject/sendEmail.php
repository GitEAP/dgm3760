<?php require_once('connectvars.php'); 
$id = $_GET['id'];

$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');
$query = "SELECT * FROM employee_directory WHERE id=$id";
$result = mysqli_query($dbconnection, $query);
$found = mysqli_fetch_array($result);
$employeeEmail = $found['email'];

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
	if(isset($_POST['submit'])) {
		//send email
		$first = $_POST['first'];
		$last = $_POST['last'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$mainMessage = $_POST['message'];

		//Build Email
		$to = "$employeeEmail";
		$to2 = 'NBA_EAP@hotmail.com';
		$subject = 'Message to Employee';
		$message = "$first $last wanted to tell you: $mainMessage
Their phone number is: $phone
and their email address is: $email";
		//Send Email
		mail($to, $subject, $message, 'FROM:' . $email);
		mail($to2, $subject, $message, 'FROM:' . $email);

		echo '<h1>Your Email was successfully sent to ' . $found['first'] . ' '. $found['last'] . '</h1>';
		echo '<a href="index.php" class="linkButton">Employees</a>';
	} else {
	?>
	<h1>Send Email</h1>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="mainForm">
		<fieldset>
			<legend>Personal Information</legend>
			<input type="text" name="first" placeholder="First Name" class="userInput" pattern="[a-zA-Z .,-]{2, 99}" title="Enter a first name" required>
			<input type="text" name="last" placeholder="Last Name" class="userInput" pattern="[a-zA-Z .,-]{2, 99}" title="Enter a last name" required>
			<input type="tel" name="phone" placeholder="Phone ex.123-555-5555" class="userInput" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Enter a valid phone number" required>
			<input type="email" name="email" placeholder="Email" class="userInput" title="Enter a valid email address" required>
		</fieldset>
		
		<fieldset>
			<legend>Write a Message</legend>
			<span>Message:</span>			<span class="charLimit">*Only 160 Characters</span>
			<textarea name="message" class="bioText" placeholder="Enter your message here..."></textarea>
		</fieldset>
	
		<input name="submit" class="submitButton" value="Send" type="submit">
				
		<div class="cancelFloat"><a href="details.php?id='. $id .'" class="linkButton">Cancel</a></div>

	</form>

<?php } ?>
</main>
<?php include_once('footer.php'); ?>