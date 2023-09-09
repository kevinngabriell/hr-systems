<?php

//retrieve connection data
include("Conn/connection.php");

if(isset($_POST['submit'])){
    
    $new_pass = $_POST['new_pass'];
    $confirm_new_pass = $_POST['confirm_new_pass'];

    if($new_pass == $confirm_new_pass){
        
        if($new_pass == '123456'){
            
        }

    } else if($new_pass != $confirm_new_pass) {
        $message = "Password tidak cocok silahkan coba lagi !!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $message = "Password masih kosong silahkan coba lagi !!";
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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap"
      rel="stylesheet"
    />
    <!-- css link -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container-fluid">

      <div class="row d-flex align-items-center">

        <div class="col d-flex flex-column justify-content-center">
          <!-- title login -->
          <div class="login-title">Ubah Password</div>
          <!-- login desc -->
          <div class="login-desc">
            Hi, silahkan ubah password anda terlebih dahulu sebelum masuk ke akun
          </div>
          <!-- form login -->
          <form action="" method="post" class="form-login d-flex flex-column justify-content-center">
            <div class="mb-3">
              <input type="password" class="form-control mb-4" id="new_pass" name="new_pass" placeholder="Masukkan password baru anda">
              <input type="password" class="form-control" id="confirm_new_pass" name="confirm_new_pass" placeholder="Konfirmasi password baru anda">
            </div>
            <div class="mt-3 mb-3 d-flex justify-content-center">
              <button type="submit" id="submit" name="submit" class="btn btn-signin">Proses</button>
            </div>
          </form>
          <!-- end of the form -->
        </div>
        <div
          class="col col-right-side d-flex justify-content-center"
          style="height: 100vh"
        >
          
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
