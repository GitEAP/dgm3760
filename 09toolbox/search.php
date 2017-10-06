<?php include_once('htmlHead.php'); ?>
<body>
<?php include_once('header.php'); ?>

<main class="mainContent clearfix">

<h1>Search</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="mainForm">	
	<fieldset>
		<legend>Search for a Movie</legend>
		<input type="text" name="user_search" class="userInput" placeholder="Search a keyword to find a movie" required pattern="[0-9a-zA-Z., -]{2,99}">
		<span>Seperate multiple search terms with ,</span>
	</fieldset>
	<input type="submit" name="submit" value="Search" class="submitButton">
</form>

<?php
	if (isset($_POST['submit'])) {
		//***************************************GET DATA***************************************
		$user_search = strtolower($_POST['user_search']);
		$user_searchClean = str_replace(',',' ',$user_search);//replaces , with spaces
		$searchWords = explode(' ', $user_searchClean);//divides words at each space
		//get each word and put in an array to build where clause.
		foreach ($searchWords as $word) {
			if(!empty($word)) {
				$searchArray[] = $word; 
			}//end of if
		}//end of foreach
		//**************************BUILD WHERE CLAUSE**************************
		$whereList = array();
		foreach ($searchArray as $word) {
			$whereList[] = "summary LIKE '%$word%'";//example summary LIKE action or summary LIKE adventure etc.
		}//end of foreach
		$whereClause = implode(' OR ', $whereList);//adds each string from $whereList and adds OR between each word.
		//default query, if user didn't search anything or just spaces
		$query = "SELECT * FROM watch_movie";
		//add where string if user did search for something.
		if (!empty($whereClause)) {
			$query .= " WHERE $whereClause";
		}
		
		
		//*************************** DISPLAY RESULTS **************************
		echo '<h2>Search Results for "' . $user_searchClean . '"</h2>';
		
		//Connect to Database
		require_once('connectvars.php');
		$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Connection failed');

		$result = mysqli_query($dbconnection, $query) or die('select query failed');
		
		//Display Results
		if (mysqli_num_rows($result) > 0) {//if something was found...
			
			while($row = mysqli_fetch_array($result) ) {
				
				$myresults = strtolower($row['summary']);
				
				foreach ($searchArray as $word) {
					$insert = '<***>' . $word . '</***>';
					$myresults = str_replace($word, $insert, $myresults);
				}
				$myresults = str_replace('***', 'span', $myresults);
				$myresults = ucfirst(substr($myresults, 0, 350));//only shows a short summary//goes back to make the first letter upper case
				
				echo '<div class="searchResults">';
				echo '<h3>' . $row['title'] . '</h3>';
				echo '<p>' . $myresults . '....<a href="index.php#'.$row['title'].'">Full Details</a></p>';
				echo '</div>';
			}//end of while
		}//end of if
		else {
			echo 'No matches found.';
		}//end of else
	}//end of isset
	?>			
	</main>
<?php mysqli_close($dbconnection); ?>
<?php include_once('footer.php'); ?>