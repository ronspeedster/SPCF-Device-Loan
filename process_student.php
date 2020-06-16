<?php
include('dbh.php');
$updateApplication = false;
$date = date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

if(isset($_POST['save'])){

    $student_id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
    $device_id = mysqli_real_escape_string($mysqli, $_POST['device']);
    $months = mysqli_real_escape_string($mysqli, $_POST['months']);
    $level = mysqli_real_escape_string($mysqli, $_POST['level']);

    $mysqli->query("INSERT INTO student (student_id, full_name, device_id, level, months, application_date) VALUES('$student_id','$fullname','$device_id', '$level','$months', '$date')") or die($mysqli->error());

    $_SESSION['message'] = "Student loan application has been added!";
    $_SESSION['msg_type'] = "success";
    header('location: student.php');
}

if(isset($_POST['update'])){
    $student_id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
    $device_id = mysqli_real_escape_string($mysqli, $_POST['device']);
    $months = mysqli_real_escape_string($mysqli, $_POST['months']);
    $application_id = strtoupper(mysqli_real_escape_string($mysqli, $_POST['application_id']));

    $mysqli->query("UPDATE student SET student_id='$student_id', full_name='$fullname', device_id='$device_id', months='$months' WHERE id='$application_id' ") or die ($mysqli->error());

    $_SESSION['message'] = "Student loan application has been updated!";
    $_SESSION['msg_type'] = "success";
    header('location: student.php');
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM student WHERE id='$id'") or die($mysqli->error());
    $_SESSION['message'] = "Application has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header('location: student.php');
}

if(isset($_GET['edit'])){
    $updateApplication = true;
    $applicattion_id = $_GET['edit'];
    $getEditAppliation = $mysqli->query("SELECT * FROM student WHERE id='$applicattion_id' ") or die ($mysqli->error());
    $newEditAppliation = $getEditAppliation->fetch_array();

    $student_id = $newEditAppliation['student_id'];
    $full_name = $newEditAppliation['full_name'];
    $months = $newEditAppliation['months'];

}
?>