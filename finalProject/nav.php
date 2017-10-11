<?php
	$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav class="mainNav">
	<ul>
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-times-circle"></i></a>
		
		<?php
		if(isset($_COOKIE['username'])) {
			echo '<li class="linkName">Hello, ' . $_COOKIE['firstname'] . '</li>';
		}
		?>
		
		<li <?php echo ($currentPage == 'index.php' ? 'class="active"' : ''); ?>><a href="index.php"><i class="fa fa-home"></i>  Home</a></li>
		
		<li <?php echo ($currentPage == 'admin.php' ? 'class="active"' : ''); ?>><a href="admin.php"><i class="fa fa-lock"></i>  Admin</a></li>
	
		<?php
		if(isset($_COOKIE['username'])) {
			echo '<li><a href="logOut.php"><i class="fa fa-sign-out"></i> Log Out</a></li>';
		}
		else {
			echo '<li ';
			echo ($currentPage == 'logIn.php' ? 'class="active"' : '');
			echo '><a href="logIn.php"><i class="fa fa-sign-in"></i> Log In</a></li>';
		}
		?>
		
	</ul>
</nav>

