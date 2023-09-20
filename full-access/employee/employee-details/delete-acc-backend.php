<?php

//check session when started
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location: ../../../login.php');
}

//connection 
include("../../../Conn/connection.php");

//get employee id
$employee_id = $_GET['employee_id'];

//check is user exist in db ?
$check_is_user_already_exist_query = "SELECT username FROM users WHERE employee_id = '$employee_id' ";
$check_is_user_already_exist_result = mysqli_query($connect, $check_is_user_already_exist_query);
$check_is_user_already_exist_rows = $check_is_user_already_exist_result->fetch_assoc();

if ($check_is_user_already_exist_rows > 0) {

    $delete_query = "DELETE FROM users WHERE employee_id = '$employee_id' ";
    $delete_result = mysqli_query($connect, $delete_query);
    //$delete_rows = $delete_result->fetch_assoc();

    if ($delete_result) {
        $message = "User telah dihapus!!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
    } else {
        $message = "Akun user gagal dihapus!!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
    }


} else {
    $message = "User tidak terdaftar silahkan buat akun baru!!";
    echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
}

?>