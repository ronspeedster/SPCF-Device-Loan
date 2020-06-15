<?php
include('dbh.php');
$updateDevice = false;

if(isset($_POST['save'])){
    $brand = strtoupper(mysqli_real_escape_string($mysqli, $_POST['brand']));
    $model = strtoupper(mysqli_real_escape_string($mysqli, $_POST['model']));
    $price = strtoupper(mysqli_real_escape_string($mysqli, $_POST['price']));

    $mysqli->query("INSERT INTO devices (brand, model, price) VALUES('$brand','$model','$price')") or die($mysqli->error());

    $_SESSION['message'] = "Device has been added!";
    $_SESSION['msg_type'] = "success";
    header('location: devices.php');

}

if(isset($_POST['update'])){
    $brand = strtoupper(mysqli_real_escape_string($mysqli, $_POST['brand']));
    $model = strtoupper(mysqli_real_escape_string($mysqli, $_POST['model']));
    $price = strtoupper(mysqli_real_escape_string($mysqli, $_POST['price']));
    $device_id = strtoupper(mysqli_real_escape_string($mysqli, $_POST['device_id']));

    $mysqli->query("UPDATE devices SET brand='$brand', model='$model', price='$price' WHERE id='$device_id'") or die ($mysqli->error());

    $_SESSION['message'] = "Device has been updated!";
    $_SESSION['msg_type'] = "success";
    header('location: devices.php');
}

if(isset($_GET['edit'])){
    $updateDevice = true;
    $device_id = $_GET['edit'];
    $getEditDevice = $mysqli->query("SELECT * FROM devices WHERE id='$device_id' ") or die ($mysqli->error());
    $newEditDevice = $getEditDevice->fetch_array();

    $brand = $newEditDevice['brand'];
    $model = $newEditDevice['model'];
    $price = $newEditDevice['price'];
}

if(isset($_GET['delete'])){
    $device_id = $_GET['delete'];
    $getEditDevice = $mysqli->query("SELECT * FROM devices WHERE id='$device_id' ") or die ($mysqli->error());
    $newEditDevice = $getEditDevice->fetch_array();

    $mysqli->query("UPDATE devices SET deleted='1' WHERE id='$device_id' ") or die ($mysqli->error());

    $_SESSION['message'] = "Device has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header('location: devices.php');
}

?>