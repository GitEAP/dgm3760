<div class="headerWrapper clearfix">
	<h1>Cookys &amp; Cafe</h1>
</div>



<div class="nav clearfix">		
	<ul>
	
	<?php
if (isset($_COOKIE['username'])) {
	?>		
		<p class="logName">Welcome <?php echo $_COOKIE['firstname'] . ' ' . $_COOKIE['lastname'];?></p>
		<li><a href="index.php">All Items</a></li>
		<li><a href="logout.php">Log-Out</a></li>
<?php
} else {
?>
		<li><a href="index.php">All Items</a></li>
		<li><a href="login.php">Log-In</a></li>

<?php
}//end of if else
?>
	</ul>
</div>


