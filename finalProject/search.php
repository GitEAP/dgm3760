<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix" id="#top">

	<div class="contentContainer clearfix">

		<aside class="contentLeft">
		<?php include_once('contentLeft.php'); ?>
		</aside>

		<section class="contentRight">	
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="mainForm">
		<fieldset>
			<legend>Search for a Movie Title</legend>
	
			<input type="text" name="search" class="userInput" placeholder="Search a Movie...">
			<span>Seperate multiple search terms with ,</span>

		</fieldset>
		
		<input type="submit" name="submit" class="submitButton" value="Search">
	</form>

	
	<?php
		if (isset($_POST['submit'])) {
		//***************************************GET DATA***************************************
		$search = strtolower($_POST['search']);
		$searchClean = str_replace(',',' ',$search);//replaces , with spaces
		$searchWords = explode(' ', $searchClean);//divides words at each space
		//get each word and put in an array to build where clause.
		foreach ($searchWords as $word) {
			if(!empty($word)) {
				$searchArray[] = $word; 
			}//end of if
		}//end of foreach
		//**************************BUILD WHERE CLAUSE**************************
		$whereList = array();
		foreach ($searchArray as $word) {
			$whereList[] = "title LIKE '%$word%'";
		}//end of foreach
		$whereClause = implode(' OR ', $whereList);//adds each string from $whereList and adds OR between each word.
		//default query, if user didn't search anything or just spaces
		$query = "SELECT * FROM final_movie";
		//add where string if user did search for something.
		if (!empty($whereClause)) {
			$query .= " WHERE $whereClause";
		}
		
		//*************************** DISPLAY RESULTS **************************
		echo '<h2>Search Results for "' . $searchClean . '"</h2>';
		
		//Connect to Database
		require_once('connectvars.php');
		$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');

		$result = mysqli_query($dbconnection, $query) or die('select query failed');
		
		//Display Results
		if (mysqli_num_rows($result) > 0) {//if something was found...
			while($row = mysqli_fetch_array($result) ) {
				
				$myresults = strtolower($row['title']);
				
				foreach ($searchArray as $word) {
					$insert = '<*** class="searchTitle">' . $word . '</***>';
					$myresults = str_replace($word, $insert, $myresults);
				}
				$myresults = str_replace('***', 'div', $myresults);
	
				echo '<div class="contentRecord clearfix">';
				
				echo '<div class="RecordColumn1">';
				echo '<a href="details.php?id='.$row['id'].'">';
				echo '<img src="images/'.$row['photo'] .'" alt="' . $row['title'] . ' Movie Poster">';
				echo '</a>';
				
				echo '</div>';//end of reocrdColumn
				
				echo '<div class="RecordColumn2">';
				echo '<h3><a href="details.php?id='.$row['id'].'">'.$myresults.'</a></h3>';
				echo '</div>';//end of record column
				echo '</div>';//end of contentRecord
			}//end of while
			echo '<a href="#top"><i class="fa fa-caret-up"></i> Back to Top</a>';
		}//end of if
		else {
			echo 'No matches found.';
		}//end of else
	}//end of isset
			mysqli_close($dbconnection);
		?>

		</section><!--//end of content right			-->
	
	</div><!--//end of content container-->
</main>

</body>
</html>