<?php include_once('htmlHead.php'); ?>

<body>

<div class="headerWrapper clearfix">
	<h1>Cookys &amp; Cafe</h1>
</div>

<div class="nav clearfix">
	<ul>
		<li class="active"><a href="index.php">View</a></li>
		<li><a href="add.php">Add</a></li>
		<li><a href="admin.php">Admin</a></li>
	</ul>
</div>

<main class="mainContent clearfix">
	
		<form action="" method="POST" enctype="multipart/form-data" class="mainForm">
			<fieldset>
				<legend>Log In</legend>
				<label><span class="inputTitle">Username:</span><input class="userInput" name="userName" value="" type="text" placeholder="username"></label>
				<label><span class="inputTitle">Password:</span><input class="userInput" name="passWord" value="" type="text" placeholder="password"></label>
			</fieldset>
			
			<div class="submitContainer"><input name="submit" type="submit" value="Log In" class="submitButton"></div>
			
		</form>	
		
</main>

<?php include_once('footer.php'); ?>