<?php
include('dbh.php');
$updateApplication = false;
$date = date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

if(isset($_POST['save'])){
	$url = $_SESSION['getURI'];
	$applicationID = mysqli_real_escape_string($mysqli, $_POST['id']);
    $classification = mysqli_real_escape_string($mysqli, $_POST['class']);
    $amount = mysqli_real_escape_string($mysqli, $_POST['amount']);

    $mysqli->query("INSERT INTO payment (class, application_id, payment, payment_date) VALUES('$classification','$applicationID','$amount','$date')") or die($mysqli->error());

    $_SESSION['message'] = "Payment has been added!";
    $_SESSION['msg_type'] = "success";

	header("location: ".$url);
}
?>