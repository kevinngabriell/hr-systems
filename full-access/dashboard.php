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

while ($company_data_row = $company_data_result->fetch_assoc()){
  $company_name_printed = $company_data_row['company_name'];
  $company_address_printed = $company_data_row['company_address'];
  $company_id_printed = $company_data_row['company_id'];


}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard HR Systems</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="dashboardstyle.css" />
    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap"
      rel="stylesheet"
    />
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
                <img
                  src="../Assets/home-logo-active.png"
                  alt=""
                  class="img-right-side"
                />
              </div>
              <div class="col">Beranda</div>
            </div>
          </a>

          <!-- Navigation links in sidebar-->
          <a href="employee/employee.php" class="sidebar-menu">
            <div class="row row-sidebar-menu-inactive">
              <div class="col-3">
                <img
                  src="../Assets/Employee-Inactive.png"
                  alt=""
                  class="img-right-side"
                />
              </div>
              <div class="col">Karyawan</div>
            </div>
          </a>

          <!-- Navigation links in sidebar-->
          <a href="payroll.php" class="sidebar-menu">
            <div class="row row-sidebar-menu-inactive">
              <div class="col-3">
                <img
                  src="../Assets/Payroll-Inactive.png"
                  alt=""
                  class="img-right-side"
                />
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
                <img
                  src="../Assets/Training-Inactive.png"
                  alt=""
                  class="img-right-side"
                />
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
                <img
                  src="../Assets/Report-Inactive.png"
                  alt=""
                  class="img-right-side"
                />
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
                <img
                  src="../Assets/CompanySetting-Inactive.png"
                  alt=""
                  class="img-right-side"
                />
              </div>
              <div class="col">Perusahaan</div>
            </div>
          </a>

          <!-- Navigation links in sidebar-->
          <a href="structure.php" class="sidebar-menu">
            <div class="row row-sidebar-menu-inactive">
              <div class="col-3">
                <img
                  src="../Assets/Structure-Inactive.png"
                  alt=""
                  class="img-right-side"
                />
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
                <img
                  src="../Assets/Asset15.png"
                  alt=""
                  class="img-right-side"
                />
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
                <a href="dashboard.php" class="nav-item nav-text-dashboard"
                  >Dashboard</a
                >
              </div>
              <!-- second column of top navbar -->
              <div class="col">
                <!-- search and notif logo -->
                <div class="row d-flex align-items-center">
                  <!-- search form -->
                  <div class="col">
                    <input
                      class="form-control"
                      type="text"
                      placeholder="Search here"
                      aria-label="default input example"
                    />
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
                    <img
                      src="../Assets/company-logo.png"
                      class="img-right-side"
                    />
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

        <!-- isi content 1-->
        <div class="row">
            <!-- column 1 terdiri dari attandance, late, status -->
            <div class="col">
                <!-- 1 row terdiri dari attandance dan late-->
                <div class="row">
                    <!-- column attandance -->
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
                    <!-- close attandance column -->
                    </div>
                    <!-- late column -->
                    <div class="col">
                        <!-- late card -->
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
                    <!-- close late column -->
                    </div>
                <!-- close late and attandance row     -->
                </div>
                <!-- employee status card -->
                <div class="card card-style-2">
                    <!-- title status card -->
                    <div class="title-card-style-2">Status karyawan</div>
                    <!-- value total employee status -->
                    <div class="row mt-3">
                        <div class="col">
                            <div class="total-text">Total</div>
                        </div>
                        <!-- count total employee -->
                        <div class="col">
                            <div class="count-total-text">30</div>
                        </div>
                    </div>
                    <!-- progress bar -->
                    <div class="progress mt-1">
                        <div class="progress-bar-3" role="progressbar" style="width: 50%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar-2" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar-1" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- 0% to 100% label -->
                    <div class="row mt-2">
                        <div class="col">
                            <div class="percantage-indicator-0-to-100" style="text-align: start;">0%</div>
                        </div>
                        <div class="col">
                            <div class="percantage-indicator-0-to-100" style="text-align: end;">100%</div>
                        </div>
                    </div>
                    <!-- employee status desc -->
                    <div class="row mt-3 d-flex align-items-center">
                        <!-- dot employee status -->
                        <div class="col-1 ">
                            <span class="dot-3"></span>
                        </div>
                        <!-- employee status label -->
                        <div class="col-7 employee-status-text">
                            Permanent
                        </div>
                        <!-- employee status count -->
                        <div class="col-2 employee-status-text">
                            40
                        </div>
                        <!-- employee status percentage -->
                        <div class="col employee-status-text">
                            30%
                        </div>
                    </div>
                    <!-- employee status desc -->
                    <div class="row mt-1 d-flex align-items-center">
                        <!-- dot employee status -->
                        <div class="col-1 ">
                            <span class="dot-2"></span>
                        </div>
                        <!-- employee status label -->
                        <div class="col-7 employee-status-text">
                            Contract
                        </div>
                        <!-- employee status count -->
                        <div class="col-2 employee-status-text">
                            40
                        </div>
                        <!-- employee status percentage -->
                        <div class="col employee-status-text">
                            30%
                        </div>
                    </div>
                    <!-- employee status desc -->
                    <div class="row mt-1 d-flex align-items-center">
                        <!-- dot employee status -->
                        <div class="col-1 ">
                            <span class="dot-1"></span>
                        </div>
                        <!-- employee status label -->
                        <div class="col-7 employee-status-text">
                            Intern
                        </div>
                        <!-- employee status count -->
                        <div class="col-2 employee-status-text">
                            40
                        </div>
                        <!-- employee status percentage -->
                        <div class="col employee-status-text">
                            30%
                        </div>
                    </div>

              </div>
            <!-- close column attandance, late, and status -->
            </div>
            <!-- column 2 terdiri dari absence, overtime, gender -->
            <div class="col">
                <!-- row absence and overtime -->
                <div class="row">
                    <!-- column absence -->
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
                    <!-- close column for absence     -->
                    </div>
                    <!-- column overtime -->
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
                    <!-- close overtime column -->
                    </div>
                <!-- close row absence and overtime -->
                </div>
                <!-- card for gender diversity -->
                <div class="card card-style-2" style="height: 57%;">
                    <!-- label for gender diversity -->
                    <div class="title-card-style-2">Gender Diversity</div>
                    <!-- row for total and gender count -->
                    <div class="row mt-3">
                        <div class="col">
                            <div class="total-text">Total</div>
                        </div>
                        <!-- count for total employee -->
                        <div class="col">
                            <div class="count-total-text">30</div>
                        </div>
                    </div>
                    <!-- progress bar for gender diversity -->
                    <div class="progress mt-1">
                        <div class="progress-bar-1" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar-2" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- row 0% to 100% gender diversity -->
                    <div class="row mt-2">
                        <div class="col">
                            <div class="percantage-indicator-0-to-100" style="text-align: start;">0%</div>
                        </div>
                        <div class="col">
                            <div class="percantage-indicator-0-to-100" style="text-align: end;">100%</div>
                        </div>
                    </div>
                    <!-- row for gender diversity desc -->
                    <div class="row mt-3 d-flex align-items-center">
                        <div class="col-1 ">
                            <span class="dot-1"></span>
                        </div>
                        <div class="col-7 employee-status-text">
                            Woman
                        </div>
                        <!-- total woman employee -->
                        <div class="col-2 employee-status-text">
                            30
                        </div>
                        <!-- percentage woman employee -->
                        <div class="col employee-status-text">
                            70%
                        </div>
                    </div>
                    <!-- row for gender diversity desc -->
                    <div class="row mt-1 d-flex align-items-center">
                        <div class="col-1 ">
                            <span class="dot-2"></span>
                        </div>
                        <div class="col-7 employee-status-text">
                            Men
                        </div>
                        <!-- count for men employee -->
                        <div class="col-2 employee-status-text">
                            10
                        </div>
                        <!-- percentage for men employee -->
                        <div class="col employee-status-text">
                            30%
                        </div>
                    </div>
                <!-- close card for gender diversity card -->
                </div>
            <!-- close column absence, overtime, gender -->
            </div>
            <!-- column 3 events/meeting -->
            <div class="col" >
                <!-- card for events/meeting -->
                <div class="card card-style-1" >
                    <!-- label for event/meeting -->
                    <div class="event-meeting-title-card">Events/Meeting</div>
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
            <!-- close column 3 -->
            </div>
        <!-- close content 1     -->
        </div>

        <!-- isi content 2 -->
        <div class="row mt-2">
            <!-- column for recent job applicant -->
            <div class="col">
                <!-- card for recent job applicant -->
                <div class="card card-style-2">
                    <!-- label for revcent job applicant -->
                    <div class="title-card-style-2 mt-1">Recent Job Applicant</div>
                    <!-- search bar job applicant -->
                    <input
                      class="form-control mt-2"
                      type="text"
                      placeholder="Search here"
                      aria-label="default input example"
                    />
                    <!-- candidate one job applicant -->
                    <div class="card event-card-style mt-4">
                        <div class="row d-flex align-items-center">
                            <!-- photo profile job applicant -->
                            <div class="col-2">
                                <img src="../Assets/company-logo.png" alt="" class="img-right-side">
                            </div>
                            <!-- Name and details job applicant -->
                            <div class="col">
                                <div class="employee-off-name">Kevin Gabriel Florentino</div>
                                <div class="employee-off-details">Ex-Product Designer | Pending</div>
                            </div>
                        </div>
                    </div>
                    <!-- candidate two job applicant -->
                    <div class="card event-card-style">
                        <div class="row d-flex align-items-center">
                            <!-- photo profile job applicant -->
                            <div class="col-2">
                                <img src="../Assets/company-logo.png" alt="" class="img-right-side">
                            </div>
                            <!-- Name and details job applicant -->
                            <div class="col">
                                <div class="employee-off-name">Kevin Gabriel Florentino</div>
                                <div class="employee-off-details">Ex-Product Designer | Pending</div>
                            </div>
                        </div>
                    </div>
                    <!-- candidate three job applicant -->
                    <div class="card event-card-style mb-4">
                        <div class="row d-flex align-items-center">
                            <!-- photo profile job applicant -->
                            <div class="col-2">
                                <img src="../Assets/company-logo.png" alt="" class="img-right-side">
                            </div>
                            <!-- Name and details job applicant -->
                            <div class="col">
                                <div class="employee-off-name">Kevin Gabriel Florentino</div>
                                <div class="employee-off-details">Ex-Product Designer | Pending</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column for employee off -->
            <div class="col">
                <!-- card for employee off -->
                <div class="card card-style-2">
                    <!-- label for employee off -->
                    <div class="title-card-style-2 mt-1">Employee Off</div>
                    <!-- date search  -->
                    <input
                      class="form-control mt-2"
                      type="date"
                      placeholder="Search here"
                      aria-label="default input example"
                    />
                    <!-- card for employee one -->
                    <div class="card event-card-style mt-4">
                        <div class="row d-flex align-items-center">
                            <!-- photo profile -->
                            <div class="col-2">
                                <img src="../Assets/company-logo.png" alt="" class="img-right-side">
                            </div>
                            <!-- employee details -->
                            <div class="col">
                                <div class="employee-off-name">Kevin Gabriel Florentino</div>
                                <div class="employee-off-details">Sick | Only today</div>
                            </div>
                        </div>
                    </div>
                    <!-- card for employee two -->
                    <div class="card event-card-style">
                        <div class="row d-flex align-items-center">
                            <!-- photo profile -->
                            <div class="col-2">
                                <img src="../Assets/company-logo.png" alt="" class="img-right-side">
                            </div>
                            <!-- employee details -->
                            <div class="col">
                                <div class="employee-off-name">Kevin Gabriel Florentino</div>
                                <div class="employee-off-details">Sick | Only today</div>
                            </div>
                        </div>
                    </div>
                    <!-- card for employee three -->
                    <div class="card event-card-style mb-4">
                        <div class="row d-flex align-items-center">
                            <!-- photo profile -->
                            <div class="col-2">
                                <img src="../Assets/company-logo.png" alt="" class="img-right-side">
                            </div>
                            <!-- employee details -->
                            <div class="col">
                                <div class="employee-off-name">Kevin Gabriel Florentino</div>
                                <div class="employee-off-details">Sick | Only today</div>
                            </div>
                        </div>
                    </div>
                <!-- close card for employee off -->
                </div>
            <!-- close column for employee off -->
            </div>
            <!-- column for annual leave -->
            <div class="col">
                <div class="card card-style-2">
                    <div class="title-card-style-2 mt-1">Annual Leave</div>
                    <canvas id="chartId" aria-label="chart"></canvas>
                    <!-- row for see all and balance -->
                    <div class="row mt-4">
                        <div class="col">
                            <div class="balance-annual-leave-title">Balance Annual Leave</div>
                        </div>
                        <div class="col">
                            <a href="" style="text-decoration: none;">
                                <div class="see-all-balance-annual-leave">See All</div>
                            </a>
                        </div>
                    <!-- close row for see all and balance -->
                    </div>
                    <!-- total remaining annual leave -->
                    <div class="total-remaining-annual-leave">
                        7 Days
                    </div>
                    <!-- link to request annual leave -->
                    <a href="" style="text-decoration: none;">
                        <div class="request-annual-leave">Request Annual Leave</div>
                    </a>

                    <!-- row for see all and title -->
                    <div class="row mt-4">
                        <div class="col">
                            <div class="balance-annual-leave-title">WFH Permission</div>
                        </div>
                        <div class="col">
                            <a href="" style="text-decoration: none;">
                                <div class="see-all-balance-annual-leave">See All</div>
                            </a>
                        </div>
                    <!-- close row for see all and balance -->
                    </div>
                    <!-- total remaining wfh permission -->
                    <div class="total-remaining-annual-leave">
                        7 Days
                    </div>
                    <!-- link to request wfh -->
                    <a href="" style="text-decoration: none;">
                        <div class="request-annual-leave">Request Annual Leave</div>
                    </a>
                </div>
            </div>
          </div>

          
        </div>
      </div>
    </div>

    

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
    
    

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
