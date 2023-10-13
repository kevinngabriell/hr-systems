<?php
//retrieve connection data
include("Conn/connection.php");

//check if submit button is clicked
if (isset($_POST['submit'])) {

  //collect data from login page
  $email_username = $_POST['email'];
  $password = $_POST['password'];

  //get user data from db
  $user_sql = "SELECT * FROM users WHERE username = ?";
  $user_result = $connect->prepare($user_sql);
  $user_result->bind_param('s', $email_username);
  $user_result->execute();
  $get_user_result = $user_result->get_result();
  $user_row = $get_user_result->fetch_assoc();

  //check is there any data value or not
  if ($user_row > 0) {
    //checking password by decrypt 
    if (password_verify($password, $user_row['password'])) {
      //looking for department
      $search_dept_query = "SELECT em.position_id, em.department_id  FROM users us JOIN employee em ON us.employee_id = em.id WHERE us.username = '$email_username';";
      $search_dept_result = $connect->query($search_dept_query);

      if ($password == '123456') {
        header('location: change-default-pass.php?username=' . $email_username);
      } else {
        //retrieve department id
        while ($dept_row = $search_dept_result->fetch_assoc()) {
          //set dept_id value
          $dept_id_result = $dept_row['department_id'];
          $position_id_result = $dept_row['position_id'];

          //session start
          session_start();

          if ($position_id_result == 'POS-HR-002') {
            //save dept session & user session
            $_SESSION['username'] = $user_row['username'];
            $_SESSION['user_department'] = $dept_id_result;
            //direct user to new page
            header('location: full-access/dashboard.php');
          } else {
            //if except HR department
            $_SESSION['username'] = $user_row['username'];
            $_SESSION['user_department'] = $dept_id_result;
            header('location: employee/dashboard.php');
          }
        }
      }

    } else {
      //passowrd is not correct
      $message = "Password gagal terverifikasi";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  } else {
    //data is empty or no user found
    $message = "Data kosong/Tidak ada data";
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
        <div class="login-title">Masuk</div>
        <!-- login desc -->
        <div class="login-desc">
          Silahkan masukkan username dan password anda </br> untuk masuk
        </div>
        <!-- form login -->
        <section id="login form">
          <form action="" method="post" class="form-login d-flex flex-column justify-content-center">
            <div class="mb-3">
              <label class="label-form mb-2">Masukkan username</label>
              <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Mohon masukkan username anda">
            </div>
            <div class="mt-2">
              <label class="label-form mb-2">Masukkan password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                placeholder="Mohon masukkan password anda">
            </div>
            <div class="mb-4 d-flex justify-content-end">
              <a href="trouble.php" class="trouble-text">Lupa password ?</a>
            </div>
            <div class="mb-3 d-flex justify-content-center">
              <button type="submit" name="submit" class="btn btn-signin">Masuk</button>
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