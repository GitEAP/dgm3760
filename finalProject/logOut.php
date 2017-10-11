<?php
//delete cookies
setcookie('username', '', time() - 3600);
setcookie('firstname', '', time() - 3600);
setcookie('lastname', '', time() - 3600);
header('Location: index.php');
?>