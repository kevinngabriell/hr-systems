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
    $message = "User telah terdaftar dengan username $check_is_user_already_exist_rows[username] !!";
    echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
} else {
    //if user is not existed then proceed to retrieve name and email 
    $employee_data_query = "SELECT DISTINCT em.employee_name, em.employee_dob ,ecd.employee_email FROM employee em JOIN employee_contact_details_db ecd ON em.id = em.id WHERE em.id = '$employee_id' AND ecd.employee_email IS NOT NULL;";
    $employee_data_result = mysqli_query($connect, $employee_data_query);

    //while retrieve data is success
    if ($employee_data_rows = $employee_data_result->fetch_assoc()) {

        //set username from first character before space
        $employee_name = $employee_data_rows['employee_name'];
        $name_full = explode(" ", $employee_name, 2);
        $first_char = $name_full[0];

        //add random 3 random number behind username
        $random_user_number = rand(1000, 9999);
        $username_set = $first_char . $random_user_number;

        //set user default password and hashing
        $default_password = '123456';
        $password = password_hash($default_password, PASSWORD_DEFAULT);

        //retrieve timezone using WIB
        date_default_timezone_set('Asia/Jakarta');
        $date_now = date('Y-m-d h:i:s', time());

        //insert proses and mailing 
        $insert_user_query = "INSERT IGNORE INTO users (username,password,employee_id, company_id, created_at, modified_at) VALUES ('$username_set','$password','$employee_id', 'COM-HR-001','$date_now', '$date_now')";
        $user_input_process = mysqli_query($connect, $insert_user_query);

        if ($user_input_process) {
            $from = "hradmin@kinglab.co.id";
            $to = $employee_data_rows['employee_email'];
            $subject = "NO REPLY - Informasi akun sistem HRD Kinglab";
            $message =
                "Dear Bapak/Ibu $employee_name,

Kami dengan senang hati ingin memberikan Anda akses ke sistem HR, yang merupakan bagian internal PT King Lab Indonesia. Sistem ini menyediakan informasi untuk membantu Anda dalam proses personalia.

Berikut adalah detail akses Anda:

URL Website: https://kinglabindonesia.com/HRSystems/login.php
Username: $username_set
Password: 123456

Kami sangat menyarankan Anda untuk segera mengakses sistem ini dan mengganti password default dengan yang lebih aman sesuai kebijakan perusahaan. Pastikan untuk menyimpan informasi ini dengan aman dan tidak mengungkapkannya kepada pihak lain yang tidak berwenang.

Jika Anda mengalami masalah dalam mengakses atau menggunakan sistem ini, jangan ragu untuk menghubungi tim dukungan kami di [Email Dukungan] atau [Nomor Telepon Dukungan]. Kami akan siap membantu Anda.

Terima kasih atas kerja keras Anda dan semangat dalam menjalankan tugas Anda.


Best Regards,
IT Support HR Systems";
            $headers = "From:" . $from;
            mail($to, $subject, $message, $headers);

            $message = "User telah berhasil dibuat !!";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";

        } else {
            $message = "Proses input gagal silahkan coba lagi!!";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
        }

    } else {
        $message = "Data dengan employee id tidak ditemukan!!";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='employee-details.php?employee_id=$employee_id';</script>";
    }

}


?>