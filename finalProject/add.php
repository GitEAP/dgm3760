<?php require_once('authorize.php'); ?>
<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">

	<div class="contentContainer clearfix">

		<aside class="contentLeft">
		<?php include_once('contentLeft.php'); ?>
		</aside>


		<section class="contentRight"> <!-- main page content goes here-->
		
		<h2>Add a New Movie Review</h2>
		
		<form action="addToDB.php" method="POST" enctype="multipart/form-data" class="mainForm">
			<fieldset>
				<legend>Movie Information</legend>
				<label><span>Title:</span><input type="text" name="title" placeholder="Whats the name of the movie?" class="userInput" required></label>
				
		
				<label><span>MPAA Rating:</span>
				<select name="rating">
					<option>G</option>
					<option>PG</option>
					<option>PG-13</option>
					<option>R</option>
				</select></label>
			</fieldset>
			
			<fieldset>
				<legend>Review</legend>
				<label><span>Star Rating:</span>
				<select name="star">
					<option value="1">1 Star</option>
					<option value="2">2 Stars</option>
					<option value="3">3 Stars</option>
					<option value="4">4 Stars</option>
					<option value="5">5 Stars</option>
				</select></label>
								
				<span>Description:</span>
				<textarea name="description" class="formText" placeholder="Write your review..."></textarea>
			</fieldset>
			
			<fieldset>
				<legend>Upload Movie Poster</legend>
				<label><input type="file" name="photo">
				<span class="uploadText">File must be saved as a .jpg file.</span>
				<span class="uploadText">Please crop to 270px x 400px, before uploading.</span>
			</label>
			</fieldset>
		
			<input type="submit" name="submit" value="Add Review" class="submitButton">
		</form>

		</section><!--//end of content right			-->
	</div><!--//end of content container-->
</main>
</body>
</html>