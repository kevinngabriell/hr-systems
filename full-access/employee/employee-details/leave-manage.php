<?php

//check session when started
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location: ../../login.php');
}

//connection 
include("../../../Conn/connection.php");

//set username variable from session
$username = $_SESSION['username'];

//retrieve employee_id
$employee_id = $_GET['employee_id'];

//set jatah cuti
$set_leave_remaining = 12;

//retrieve data sisa jatah cuti
$check_is_there_any_data = "SELECT leave_remaining FROM leave_allowance WHERE employee_id = '$employee_id'";
$check_is_result = $connect->query($check_is_there_any_data);

while ($check_is_rows = $check_is_result->fetch_assoc()) {
    $leave_allowance_data = $check_is_rows['leave_remaining'];
}

//bool false itu kosong datanya atau true datanya ada isi
$isset = isset($leave_allowance_data);

//check is allowance null or not
if ($isset == false) {
    //insert query process
    $insert_leave_query = "INSERT IGNORE INTO leave_allowance (employee_id, leave_remaining) VALUES ('$employee_id', '$set_leave_remaining')";
    $insert_leave_process = mysqli_query($connect, $insert_leave_query);

    //check is insert process true
    if ($insert_leave_process) {
        $message = "Cuti karyawan telah ditambahkan !!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
    } else {
        $message = "Cuti karyawan gagal ditambahkan !!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
    }

} else {
    //get current month
    $current_date = date("m");

    //check if today is january
    if($current_date == "01"){
        //update query process
        $update_leave_query = "UPDATE leave_allowance SET leave_remaining = '$set_leave_remaining' WHERE employee_id = '$employee_id'";
        $update_leave_process = mysqli_query($connect, $update_leave_query);

        //check is update success ?
        if ($update_leave_process) {
            $message = "Cuti karyawan telah diupdate !!";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
        } else {
            $message = "Cuti karyawan gagal diupdate !!";
            echo "<script type='text/javasc
            ript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
        }
    //not in january    
    } else {
        $message = "Anda tidak dapat update cuti sekarang !!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
    }

}

?>