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

//if user not exists
if ($check_is_user_already_exist_rows > 0) {

    //set user default password and hashing
    $default_password = '123456';
    $password = password_hash($default_password, PASSWORD_DEFAULT);

    //update password
    $update_user_pass_query = "UPDATE users SET password = '$password' WHERE employee_id = '$employee_id' ";
    $update_user_pass_result = mysqli_query($connect, $update_user_pass_query);

    $employee_data_query = "SELECT em.employee_name, em.employee_dob ,ecd.employee_email FROM employee em JOIN employee_contact_details_db ecd ON ecd.id = em.id WHERE em.id = '$employee_id';";
    $employee_data_result = mysqli_query($connect, $employee_data_query);
    $employee_data_rows = $employee_data_result->fetch_assoc();

    $employee_name = $employee_data_rows['employee_name'];
    $username_set = $check_is_user_already_exist_rows['username'];

    if ($update_user_pass_result) {
        $from = "hradmin@kinglab.co.id";
        $to = $employee_data_rows['employee_email'];
        $subject = "Reset password akun sistem HRD Kinglab";
        $message =
            " Dear Bapak/Ibu $employee_name,


            Kami ingin memberitahu Anda bahwa sebuah permintaan reset password telah diterima untuk akun Anda di sistem kami. Password default akun Anda telah diubah menjadi 123456 untuk memudahkan Anda dalam mengakses kembali akun tersebut.

            Informasi Akun:

            Username: $username_set
            Password Baru: 123456


            Kami sangat menyarankan Anda untuk segera mengakses sistem ini dan mengganti password default dengan yang lebih aman sesuai kebijakan perusahaan. Pastikan untuk menyimpan informasi ini dengan aman dan tidak mengungkapkannya kepada pihak lain yang tidak berwenang.

            Jika Anda tidak merasa melakukan permintaan reset password ini atau jika Anda mengalami masalah dalam mengakses akun Anda, harap segera hubungi tim dukungan kami di [Email Dukungan] atau [Nomor Telepon Dukungan]. Kami akan dengan senang hati membantu Anda menyelesaikan masalah ini.

            Terima kasih atas perhatiannya dan kami mohon maaf atas ketidaknyamanan ini.

        Best Regards,
        IT Support HR Systems";
        $headers = "From:" . $from;
        mail($to, $subject, $message, $headers);

        $message = "Reset password berhasil!!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
    } else {
        $message = "Reset password gagal!!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
    }

} else {
    $message = "User tidak terdaftar silahkan buat akun baru!!";
    echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
}


?>