<?php
include('dbh.php');
$updateApplication = false;
$date = date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

if(isset($_POST['save'])){
	$url = $_SESSION['getURI'];

	header("location: ".$url);
}
?>