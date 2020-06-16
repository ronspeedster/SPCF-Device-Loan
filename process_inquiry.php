<?php
include('dbh.php');
$date = date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

if(isset($_POST['save'])){

    $full_name = mysqli_real_escape_string($mysqli, $_POST['full_name']);
    $contact_no = mysqli_real_escape_string($mysqli, $_POST['contact_no']);
    $email_address = mysqli_real_escape_string($mysqli, $_POST['email_address']);

    $mysqli->query("INSERT INTO inquiry (full_name, contact_no, email_address, date_inquired) VALUES('$full_name','$contact_no','$email_address', '$date')") or die($mysqli->error());
    $_SESSION['message'] = "An inquiry has been added!";
    $_SESSION['msg_type'] = "success";
    header('location: inquiry.php');
}

?>