<?php
//make sure user is logged in
if (!isset($_COOKIE['username'])) {
	echo '<main class="mainContent"><p>Please <a href="login.php">log in</a> to access this page</p></main>';
	exit();
}
?>