<?php
session_start();
include 'db.php';

$update = false;
$name = "";
$address = "";
$id = 0;

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];

    $sql = "INSERT INTO data (name,address) VALUES('$name','$address') limit 1";
    $conn->query($sql);

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";
    header("location:index.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM data where id=$id") or die($conn->error);
    $_SESSION['message'] = "Record has been Deleted";
    $_SESSION['msg_type'] = "Danger";
    header("location:index.php");
}

// for editing the values 

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM data WHERE id =$id") or die($conn->error);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $address = $row['address'];
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $conn->query("UPDATE data SET name='$name', address='$address' WHERE id=$id") or die($mysqli->error);
    $_SESSION['message'] = "Record has Successfully updated!";
    $_SESSION['msg_type'] = "warning";
    header("location:index.php");
}
