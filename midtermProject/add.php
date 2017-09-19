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
			<span>Bio:</span>
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
			<span>Please crop to 300px x 200px, before uploading.</span>
			</label>
		</fieldset>
		
		<input name="submit" class="submitButton" value="Add Employee" type="submit">
	</form>
	
</main>
<?php include_once('footer.php'); ?>