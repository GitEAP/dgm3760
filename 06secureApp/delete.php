<?php
require_once('authorize.php');
require_once('connectvars.php');

$id = $_GET['id'];

//Build db connection
$dbconnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('connection failed');
//Build query
$query = "DELETE FROM hotel_simple WHERE id=$id";
//talk to database
$result = mysqli_query($dbconnection, $query) or die('Query failed');

//Return to the admin page
header('Location: admin.php');
?>