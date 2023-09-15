<?php

//retrieve connection data
include("Conn/connection.php");

if (isset($_POST['submit'])) {

  $is_username = $_POST['username'];

  $search_employee_query = "SELECT emcd.employee_email FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db emcd ON em.id = emcd.id WHERE us.username = ? OR em.employee_id = ?;";
  $search_employee_result = $connect->prepare($search_employee_query);
  $search_employee_result->bind_param('is', $is_username, $is_username);
  $search_employee_result->execute();
  $get_search_employee_result = $search_employee_result->get_result();
  $search_employee_row = $get_search_employee_result->fetch_assoc();

  $find_username_query = "SELECT us.username FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecdb ON em.id = ecdb.id WHERE us.username = ? OR em.employee_id = ?;";
  $find_username_result = $connect->prepare($find_username_query);
  $find_username_result->bind_param('is', $is_username, $is_username);
  $find_username_result->execute();
  $get_find_username_result = $find_username_result->get_result();
  $find_username_row = $get_find_username_result->fetch_assoc();


  if($search_employee_row > 0){
    //set user default password and hashing
    $default_password = '123456';
    $password = password_hash($default_password, PASSWORD_DEFAULT);

    if($find_username_row > 0 ){
      $find_username = $find_username_row['username'];

      echo $find_username;

    }

    //update password
    // $update_user_pass_query = "UPDATE users SET password = '$password' WHERE employee_id = '$employee_id' ";
    // $update_user_pass_result = mysqli_query($connect, $update_user_pass_query);

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
          Anda lupa akun anda ? silahkan isi username anda /</br>id karyawan anda
        </div>
        <!-- form login -->
        <form action="" method="post" class="form-login d-flex flex-column justify-content-center">
          <div class="mb-5">
            <label class="label-form mb-2">Masukkan username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp"
              placeholder="Mohon masukkan username / ID karyawan anda">
          </div>
          <div class="mt-5 mb-3 d-flex justify-content-center">
            <button type="submit" id="submit" name="submit" class="btn btn-signin">Kirim</button>
          </div>
        </form>
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