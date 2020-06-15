<?php
include('dbh.php');
$updateApplication = false;
if(isset($_POST['save'])){

    $employee_id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
    $device_id = mysqli_real_escape_string($mysqli, $_POST['device']);
    $months = mysqli_real_escape_string($mysqli, $_POST['months']);

    $mysqli->query("INSERT INTO employee (employee_id, full_name, device_id, months) VALUES('$employee_id','$fullname','$device_id','$months')") or die($mysqli->error());

    $_SESSION['message'] = "Employee loan application has been added!";
    $_SESSION['msg_type'] = "success";
    header('location: employee.php');
}

if(isset($_POST['update'])){
    $employee_id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
    $device_id = mysqli_real_escape_string($mysqli, $_POST['device']);
    $months = mysqli_real_escape_string($mysqli, $_POST['months']);
    $application_id = strtoupper(mysqli_real_escape_string($mysqli, $_POST['application_id']));

    $mysqli->query("UPDATE employee SET employee_id='$employee_id', full_name='$fullname', device_id='$device_id', months='$months' WHERE id='$application_id' ") or die ($mysqli->error());

    $_SESSION['message'] = "Employee loan application has been updated!";
    $_SESSION['msg_type'] = "success";
    header('location: employee.php');
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM employee WHERE id='$id'") or die($mysqli->error());
    $_SESSION['message'] = "Application has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header('location: employee.php');
}

if(isset($_GET['edit'])){
    $updateApplication = true;
    $applicattion_id = $_GET['edit'];
    $getEditAppliation = $mysqli->query("SELECT * FROM employee WHERE id='$applicattion_id' ") or die ($mysqli->error());
    $newEditAppliation = $getEditAppliation->fetch_array();

    $employee_id = $newEditAppliation['employee_id'];
    $full_name = $newEditAppliation['full_name'];
    $months = $newEditAppliation['months'];

}
?>