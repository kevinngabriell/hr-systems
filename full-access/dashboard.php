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
$company_data_query = "SELECT cy.company_id, cy.company_name, cy.company_address FROM users us JOIN company cy ON us.company_id = cy.company_id WHERE us.username = '$username';";
$company_data_result = $connect->query($company_data_query);

while ($company_data_row = $company_data_result->fetch_assoc()) {
  $company_name_printed = $company_data_row['company_name'];
  $company_address_printed = $company_data_row['company_address'];
  $company_id_printed = $company_data_row['company_id'];
}

$user_data_query = "SELECT em.employee_name, ecd.employee_email FROM users us JOIN employee em ON us.employee_id = em.id JOIN employee_contact_details_db ecd ON us.employee_id = ecd.id WHERE us.username = '$username';";
$user_data_results = $connect->query($user_data_query);

while ($user_data_row = $user_data_results->fetch_assoc()) {
  $employee_name_printed = $user_data_row['employee_name'];
  $employee_email_printed = $user_data_row['employee_email'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard HR Systems</title>
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
          <div class="row row-sidebar-menu">
            <div class="col-3">
              <img src="../Assets/home-logo-active.png" alt="" class="img-right-side" />
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
          <div class="row row-sidebar-menu-inactive">
            <div class="col-3">
              <img src="../Assets/CompanySetting-Inactive.png" alt="" class="img-right-side" />
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
              <a href="dashboard.php" class="nav-item nav-text-dashboard">Dashboard</a>
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
                  <div class="profile-name">
                    <?php echo $employee_name_printed ?>
                  </div>
                  <div class="profile-email">
                    <?php
                    if ($employee_email_printed == NULL) {
                      echo "Email belum terdata";
                    } else {
                      echo $employee_email_printed;
                    }

                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>

        <div class="row">
          <div class="col">
            <div class="row">
              <!-- kehadiran -->
              <div class="col">
                <!-- card attandance -->
                <div class="card card-style-1">
                  <!-- image asset attandance -->
                  <img src="../Assets/Asset2.png" class="image-card-style-1">
                  <!-- text attandance -->
                  <div class="title-card-style-1">Kehadiran</div>
                  <!-- count total employee attandance -->
                  <div class="value-card-style-1">40</div>
                  <!-- percatange row -->
                  <div class="row d-flex align-items-center">
                    <!-- image percantage column -->
                    <div class="col-2  d-flex align-items-center" style="padding-right: 0%;">
                      <img src="../Assets/Asset6.png" class="image-green-indicator">
                    </div>
                    <!-- text count percantage -->
                    <div class="col  d-flex align-items-center" style="padding-left: 3%;">
                      <div class="percantage-green-value">13,9%</div>
                    </div>
                  </div>
                  <!-- is increased or decreased -->
                  <div class="desc-percantage-text">Increased vs last month</div>
                  <!-- close card attandance -->
                </div>
              </div>
              <!-- keterlambatan -->
              <div class="col">
                <div class="card card-style-1">
                  <!-- late asset image -->
                  <img src="../Assets/Asset1.png" class="image-card-style-1">
                  <!-- text employee late -->
                  <div class="title-card-style-1">Keterlambatan</div>
                  <!-- value employee late -->
                  <div class="value-card-style-1">40</div>
                  <!-- row percantage employee late -->
                  <div class="row d-flex align-items-center">
                    <!-- image employee late -->
                    <div class="col-2  d-flex align-items-center" style="padding-right: 0%;">
                      <img src="../Assets/Asset6.png" class="image-green-indicator">
                    </div>
                    <!-- value employee late -->
                    <div class="col  d-flex align-items-center" style="padding-left: 3%;">
                      <div class="percantage-green-value">
                        13,9%
                      </div>
                    </div>
                  </div>
                  <!-- is increased or decreased -->
                  <div class="desc-percantage-text">Increased vs last month</div>
                  <!-- close late card -->
                </div>
              </div>
              <!-- absen -->
              <div class="col">
                <!-- card for absence -->
                <div class="card card-style-1">
                  <!-- image asset for absence -->
                  <img src="../Assets/Asset3.png" class="image-card-style-1">
                  <!-- label for absence -->
                  <div class="title-card-style-1">Absen</div>
                  <!-- count value for absence -->
                  <div class="value-card-style-1">40</div>
                  <!-- row percentage absence -->
                  <div class="row d-flex align-items-center">
                    <div class="col-2  d-flex align-items-center" style="padding-right: 0%;">
                      <img src="../Assets/Asset6.png" class="image-green-indicator">
                    </div>
                    <div class="col  d-flex align-items-center" style="padding-left: 3%;">
                      <div class="percantage-green-value">13,9%</div>
                    </div>
                  </div>
                  <!-- is increased or decreased -->
                  <div class="desc-percantage-text">Increased vs last month</div>
                  <!-- close card for absence -->
                </div>
              </div>
              <!-- lembur -->
              <div class="col">
                <!-- overtime card -->
                <div class="card card-style-1">
                  <!-- overtime image -->
                  <img src="../Assets/Asset4.png" class="image-card-style-1">
                  <!-- overtime label -->
                  <div class="title-card-style-1">Lembur</div>
                  <!-- employee overtime count -->
                  <div class="value-card-style-1">40</div>
                  <!-- percentage employee overtime -->
                  <div class="row d-flex align-items-center">
                    <div class="col-2  d-flex align-items-center" style="padding-right: 0%;">
                      <img src="../Assets/Asset6.png" class="image-green-indicator">
                    </div>
                    <div class="col  d-flex align-items-center" style="padding-left: 3%;">
                      <div class="percantage-green-value">13,9%</div>
                    </div>
                  </div>
                  <!-- is increased or decreased -->
                  <div class="desc-percantage-text">Increased vs last month</div>
                  <!-- close overtime card -->
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <div class="card card-style-1">
                  <div class="row d-flex align-items-center justify-content-center mb-3">
                    <div class="col d-flex justify-content-center">
                      <a href="" style="text-decoration: none; text-align: center;">
                        <img src="../Assets/time-record.png" alt="" style="width: 70%;">
                        <div class="title-card-style-1 mt-2">Absen</div>
                      </a>
                    </div>
                    <div class="col d-flex justify-content-center">
                      <a href="permission-form.php" style="text-decoration: none; text-align: center;">
                        <img src="../Assets/leave-permission.png" alt="" style="width: 70%;">
                        <div class="title-card-style-1 mt-2">Izin</div>
                      </a>
                    </div>
                    <div class="col d-flex justify-content-center">
                      <a href="" style="text-decoration: none; text-align: center;">
                        <img src="../Assets/unknown-menu.png" alt="" style="width: 70%;">
                        <div class="title-card-style-1 mt-2">Soon</div>
                      </a>
                    </div>
                    <div class="col d-flex justify-content-center">
                      <a href="" style="text-decoration: none; text-align: center;">
                        <img src="../Assets/unknown-menu.png" alt="" style="width: 70%;">
                        <div class="title-card-style-1 mt-2">Soon</div>
                      </a>
                    </div>
                    <div class="col d-flex justify-content-center">
                      <a href="" style="text-decoration: none; text-align: center;">
                        <img src="../Assets/unknown-menu.png" alt="" style="width: 70%;">
                        <div class="title-card-style-1 mt-2">Soon</div>
                      </a>
                    </div>
                    <div class="col d-flex justify-content-center">
                      <a href="" style="text-decoration: none; text-align: center;">
                        <img src="../Assets/unknown-menu.png" alt="" style="width: 70%;">
                        <div class="title-card-style-1 mt-2">Soon</div>
                      </a>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="row">
              <div class="col">
                <!-- card for events/meeting -->
                <div class="card card-style-1">
                  <!-- label for event/meeting -->
                  <div class="event-meeting-title-card">Permohonan</div>
                  <!-- desc for events/meeting -->
                  <div class="event-meeting-desc-card">This is your meeting for today 18 July 2023</div>
                  <!-- card for events/meeting -->
                  <a href="" style="text-decoration: none;">
                    <div class="card event-card-style">
                      <!-- row for event card content -->
                      <div class="row d-flex align-items-center">
                        <!-- image asset for interview -->
                        <div class="col-4">
                          <img src="../Assets/Asset19.png" style="width: 90%;">
                        </div>
                        <div class="col">
                          <!-- event meetings title -->
                          <div class="event-detail-text-style">Interview Candidate John Doe</div>
                          <!-- event meetings details -->
                          <div class="event-detail-text-style mt-2">14.30 | Zoom Meeting</div>
                        </div>
                      </div>
                    </div>
                  </a>
                  <!-- card for events/meeting -->
                  <a href="" style="text-decoration: none;">
                    <div class="card event-card-style">
                      <!-- row for event card content -->
                      <div class="row d-flex align-items-center">
                        <!-- image asset for interview -->
                        <div class="col-4">
                          <img src="../Assets/Asset19.png" style="width: 90%;">
                        </div>
                        <div class="col">
                          <!-- event meetings title -->
                          <div class="event-detail-text-style">Interview Candidate John Doe</div>
                          <!-- event meetings details -->
                          <div class="event-detail-text-style mt-2">14.30 | Zoom Meeting</div>
                        </div>
                      </div>
                    </div>
                  </a>
                  <!-- card for events/meeting -->
                  <a href="" style="text-decoration: none;">
                    <div class="card event-card-style" style="margin-bottom: 5%;">
                      <!-- row for event card content -->
                      <div class="row d-flex align-items-center">
                        <!-- image asset for interview -->
                        <div class="col-4">
                          <img src="../Assets/Asset19.png" style="width: 90%;">
                        </div>
                        <div class="col">
                          <!-- event meetings title -->
                          <div class="event-detail-text-style">Interview Candidate John Doe</div>
                          <!-- event meetings details -->
                          <div class="event-detail-text-style mt-2">14.30 | Zoom Meeting</div>
                        </div>
                      </div>
                    </div>
                  </a>
                  <!-- close card for events/meeting -->
                </div>
              </div>
            </div>
            <div class="row mt-4">
                  <div class="col">
                    <!-- <div class="card card-style-1">
                      te
                    </div> -->
                  </div>
            </div>
          </div>
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