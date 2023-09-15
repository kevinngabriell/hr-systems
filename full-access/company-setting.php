<?php

//check session when started
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['username'])) {
  header('location: ../login.php');
}

//connection 
include("../Conn/connection.php");

//set username variable from session
$username = $_SESSION['username'];

//retrieve company name
$company_data_query = "SELECT cy.company_name, cy.company_address FROM users us JOIN company cy ON us.company_id = cy.company_id;";
$company_data_result = $connect->query($company_data_query);

while ($company_data_row = $company_data_result->fetch_assoc()) {
  $company_name_printed = $company_data_row['company_name'];
  $company_address_printed = $company_data_row['company_address'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Company Setting HR Systems</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="stylesheet" href="dashboardstyle.css" />
  <!-- font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="container-fluid">
    <div class="row h-100">
      <!-- column left side all -->
      <div class="col-2" style="margin-left: 1%; margin-right: 1%">
        <!-- row left side company profile-->
        <div class="row row-company-name-and-logo">
          <!-- column for company logo -->
          <div class="col-4">
            <img src="../Assets/company-logo.png" alt="" />
          </div>
          <!-- column for company name and address -->
          <div class="col">
            <div class="company-name">
              <?= $company_name_printed ?>
            </div>
            <div class="company-address">
              <?= $company_address_printed ?>
            </div>
          </div>
        </div>

        <!-- main menu text -->
        <div class="main-menu-text">Menu utama</div>

        <!-- Navigation links in sidebar-->
        <a href="dashboard.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Dashboard-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Beranda</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="employee/employee.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Employee-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Karyawan</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="payroll.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Payroll-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Gaji</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="performance.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Performance-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Performa</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="training.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Training-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Pelatihan</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="event.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Event-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Acara</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="report.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Report-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Laporan</div>
          </div>
        </a>

        <!-- main menu text -->
        <div class="mt-4 main-menu-text">Pengaturan</div>

        <!-- Navigation links in sidebar-->
        <a href="company-setting.php" class="sidebar-menu">
          <div class="row row-sidebar-menu">
            <div class="col-3">
              <img src="../Assets/Asset33.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Perusahaan</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="structure.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Structure-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Struktur</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="attandance-setting.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/Attandance-Inactive.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Kehadiran</div>
          </div>
        </a>

        <!-- Navigation links in sidebar-->
        <a href="../logout.php" class="sidebar-menu">
          <div class="row row-sidebar-menu-logout">
            <div class="col-3">
              <img src="../Assets/Asset15.png" alt="" class="img-right-side" />
            </div>
            <div class="col">Keluar</div>
          </div>
        </a>
      </div>

      <!-- right side column -->
      <div class="col">

        <!-- top navbar -->
        <nav class="navbar">
          <!-- row navbar -->
          <div class="row row-right-navbar">
            <!-- first column of top navbar -->
            <div class="col">
              <a href="company-setting.html" class="nav-item nav-text-dashboard">Company Setting</a>
            </div>
            <!-- second column of top navbar -->
            <div class="col">
              <!-- search and notif logo -->
              <div class="row d-flex align-items-center">
                <!-- search form -->
                <div class="col">
                  <input class="form-control" type="text" placeholder="Search here"
                    aria-label="default input example" />
                </div>
                <!-- notification logo -->
                <div class="col-2">
                  <img src="../Assets/Asset17.png" class="img-right-side" />
                </div>
              </div>
            </div>
            <!-- third column of top navbar -->
            <div class="col">
              <!-- row of profile @top navbar -->
              <div class="row d-flex align-items-center">
                <!-- profile picture -->
                <div class="col-2">
                  <img src="../Assets/company-logo.png" class="img-right-side" />
                </div>
                <!-- profile name and email -->
                <div class="col">
                  <div class="profile-name">Kevin Gabriel</div>
                  <div class="profile-email">kevingabriel@xyz.com</div>
                </div>
              </div>
            </div>
          </div>
        </nav>

        <div class="row d-flex align-items-center justify-content-center"
          style="text-align: center; margin-top: auto; margin-bottom: auto;">
          <img src="../Assets/Asset29.png" alt="" style="width: 30%;">
          <p class="under-construction-text">Under Construction</p>
          <p class="under-construction-text-desc">Halaman ini sedang dalam proses pengembangan dan akan segera hadir
            dalam waktu dekat</p>
        </div>



      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>



  <script>
    var chrt = document.getElementById("chartId").getContext("2d");
    var chartId = new Chart(chrt, {
      type: 'doughnut',
      data: {
        labels: ["HTML", "CSS", "JAVASCRIPT", "CHART.JS", "JQUERY", "BOOTSTRP"],
        datasets: [{
          label: "online tutorial subjects",
          data: [20, 40, 13, 35, 20, 38],
          backgroundColor: ['yellow', 'aqua', 'pink', 'lightgreen', 'gold', 'lightblue'],
          hoverOffset: 5
        }],
      },
      options: {
        responsive: false,
      },
    });
  </script>
</body>

</html>