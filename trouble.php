<?php
date_default_timezone_set('Asia/Jakarta');
//retrieve connection data
include("Conn/connection.php");

function sendMessage($chatID, $messaggio, $token)
{
  //echo "sending message to " . $chatID . "\n";

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

if (isset($_POST['submit'])) {
  //get username from form
  $is_username = $_POST['username'];
  //find username and employee id query
  $find_username_query = "SELECT us.username, us.employee_id FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecdb ON em.id = ecdb.id WHERE us.username = ?;";
  $find_username_result = $connect->prepare($find_username_query);
  $find_username_result->bind_param('s', $is_username);
  $find_username_result->execute();
  $get_find_username_result = $find_username_result->get_result();
  $find_username_row = $get_find_username_result->fetch_assoc();
  //set user default password and hashing
  $default_password = '123456';
  $password = password_hash($default_password, PASSWORD_DEFAULT);

  if ($find_username_row > 0) {
    //define username and employee id 
    $find_username = $find_username_row['username'];
    $employee_id = $find_username_row['employee_id'];

    //looking for chat id data query
    $telegram_id_query = "SELECT chat_id FROM telegram_info WHERE employee_id = '$employee_id'";
    $telegram_id_result = $connect->query($telegram_id_query);
    //retrieve chat id
    while ($telegram_id_rows = $telegram_id_result->fetch_assoc()) {
      $chat_id = $telegram_id_rows['chat_id'];

      if (var_dump(empty($chat_id)) == false) {
        $id_otp = rand(0, 9999999999);
        $otp = rand(000000, 999999);
        $created_date = date('Y-m-d H:i:s');
        $expired_date = date('Y-m-d H:i:s', strtotime('+ 15 minutes', strtotime($created_date)));

        $token = "6663215498:AAHPYjolpr-i4ti0clZrxEVNKVXJnqwUT4s";
        $chatid = "$chat_id";
        sendMessage($chatid, "Dear Bapak/Ibu $employee_name,

Kode OTP anda adalah $otp. Kode tersebut akan berakhir dalam 15 menit. 

Abaikan pesan ini jika anda tidak melakukan hal apapun yang membutuhkan verifikasi lebih lanjut

Best Regards,
IT Support HR Systems", $token);

        $insert_otp_query = "INSERT IGNORE INTO otp_log (otp, created_time, expired_time) VALUES ('$otp', '$created_date', '$expired_date');";
        $insert_otp_process = mysqli_query($connect, $insert_otp_query);

        header('location: trouble-otp.php?employee_id=' . $employee_id);
      } else if (var_dump(empty($chat_id)) == true){
        $message = "Silahkan ajukan reset password melalui HRD anda";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }

    }
  } else {
    //data is empty or no user found
    $message = "Akun anda tidak ditemukan silahkan coba lagi";
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
  <link href="https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
  <!-- css link -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="container-fluid">
    <div class="row d-flex align-items-center">
      <div class="col d-flex flex-column justify-content-center">
        <!-- title login -->
        <div class="login-title">Reset Account</div>
        <!-- login desc -->
        <div class="login-desc">
          Anda lupa akun anda ? silahkan isi username anda
        </div>
        <!-- form login -->
        <section id="trouble-form">
          <form action="" method="post" class="form-login d-flex flex-column justify-content-center">
            <div class="mt-2">
              <label class="label-form mb-2">Masukkan username</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp"
                placeholder="Mohon masukkan username anda">
            </div>
            <div class="mb-4 d-flex justify-content-end">
              <a href="login.php" class="trouble-text">Kembali Sign In</a>
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