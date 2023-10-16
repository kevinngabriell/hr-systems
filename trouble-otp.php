<?php
date_default_timezone_set('Asia/Jakarta');

//retrieve connection data
include("Conn/connection.php");
//get employee id
$employee_id = $_GET['employee_id'];
//get employee name 
$employee_name_query = "SELECT employee.employee_name FROM employee WHERE employee.id = '$employee_id';";
$employee_name_result = $connect->query($employee_name_query);
//retrieve employee name
while ($employee_name_rows = $employee_name_result->fetch_assoc()) {
    $employee_name = $employee_name_rows['employee_name'];
}
//get username  
$get_username_query = "SELECT username FROM users WHERE employee_id = '$employee_id'";
$username_result = $connect->query($get_username_query);
while ($username_rows = $username_result->fetch_assoc()) {
    $username = $username_rows['username'];
}
//function to send message 
function sendMessage($chatID, $messaggio, $token)
{
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//looking for chat id data query
$telegram_id_query = "SELECT chat_id FROM telegram_info WHERE employee_id = '$employee_id'";
$telegram_id_result = $connect->query($telegram_id_query);
//retrieve chat id
while ($telegram_id_rows = $telegram_id_result->fetch_assoc()) {
    $chat_id = $telegram_id_rows['chat_id'];
}

if (isset($_POST['submit'])) {

    $kode_otp = $_POST['otp'];
    $look_expired_time = "SELECT expired_time FROM otp_log WHERE otp = '$kode_otp';";
    $look_expired_process = $connect->query($look_expired_time);

    while ($look_expired_rows = $look_expired_process->fetch_assoc()) {
        $exp_time = $look_expired_rows['expired_time'];
    }

    $date_now = date('Y-m-d H:i:s');

    if ($exp_time > $date_now) {

        $delete_otp_query = "DELETE FROM otp_log WHERE otp = '$kode_otp';";
        $delete_otp_process = mysqli_query($connect, $delete_otp_query);

        //set user default password and hashing
        $default_password = '123456';
        $password = password_hash($default_password, PASSWORD_DEFAULT);

        $updated_user_password_query = "UPDATE users SET users.password = '$password', modified_at = '$date_now' WHERE employee_id = '$employee_id'";
        $updated_user_password_process = mysqli_query($connect, $updated_user_password_query);

        if ($updated_user_password_process) {
            $token = "6663215498:AAHPYjolpr-i4ti0clZrxEVNKVXJnqwUT4s";
            $chatid = "$chat_id";
            sendMessage($chatid, "Dear Bapak/Ibu $employee_name,

Password anda telah berhasil direset menjadi password default. 

Saat ini akses informasi akun anda menjadi sebagai berikut 

Username : $username
Password : 123456

Kami harap anda segera merubah password anda untuk melindungi akses keamanan akun anda. 

Demikian yang dapat kami sampaikan, jika anda membutuhkan bantuan lebih lanjut anda dapat menghubungi HRD anda.
        
Best Regards,
IT Support HR Systems", $token);

            $message = "Password berhasil direset!!";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='login.php'; </script>";
        } else {
            $message = "Password gagal direset!!";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='trouble.php';</script>";
        }

    } else {
        $message = "OTP Expired!! Silahkan ajukan kembali kode OTP anda !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>HR Management Systems</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap"
        rel="stylesheet" />
    <!-- css link -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="col d-flex flex-column justify-content-center">
                <!-- title login -->
                <div class="login-title">Kode OTP</div>
                <!-- login desc -->
                <div class="login-desc">
                    Masukkan kode OTP anda
                </div>
                <!-- form login -->
                <section id="trouble-form">
                    <form action="" method="post" class="form-login d-flex flex-column justify-content-center">
                        <div class="mb-5">
                            <label class="label-form mb-2">Kode OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" aria-describedby="emailHelp"
                                placeholder="Mohon masukkan kode OTP anda">
                        </div>
                        <div class="mt-5 mb-3 d-flex justify-content-center">
                            <button type="submit" id="submit" name="submit" class="btn btn-signin">Kirim</button>
                        </div>
                    </form>
                </section>
                <!-- end of the form -->
            </div>
            <div class="col col-right-side d-flex justify-content-center" style="height: 100vh">

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>