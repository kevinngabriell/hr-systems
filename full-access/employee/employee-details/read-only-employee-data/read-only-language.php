<?php

//ignore error
error_reporting(E_ERROR);

//check session when started
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('location: ../../../../login.php');
}

//connection 
include("../../../../Conn/connection.php");

//set username variable from session
$username = $_SESSION['username'];
$employee_id = $_GET['employee_id'];

//retrieve company name
$company_data_query = "SELECT cy.company_name, cy.company_address FROM users us JOIN company cy ON us.company_id = cy.company_id;";
$company_data_result = $connect->query($company_data_query);

while ($company_data_row = $company_data_result->fetch_assoc()) {
    $company_name_printed = $company_data_row['company_name'];
    $company_address_printed = $company_data_row['company_address'];
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
    <title>Employee HR Systems</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="employeestyle.css" />
    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap"
        rel="stylesheet" />
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
                        <img src="../../../../Assets/company-logo.png" alt="" />
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
                <a href="../../../dashboard.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Dashboard-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Beranda</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../employee.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu">
                        <div class="col-3">
                            <img src="../../../../Assets/Asset21.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Karyawan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../payroll.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Payroll-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Gaji</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../performance.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Performance-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Performa</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../training.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Training-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Pelatihan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../event.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Event-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Acara</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../report.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Report-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Laporan</div>
                    </div>
                </a>

                <!-- main menu text -->
                <div class="mt-4 main-menu-text">Peraturan</div>

                <!-- Navigation links in sidebar-->
                <a href="../../../company-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/CompanySetting-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Perusahaan</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../structure.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Structure-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Struktur</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../attandance-setting.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-inactive">
                        <div class="col-3">
                            <img src="../../../../Assets/Attandance-Inactive.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Kehadiran</div>
                    </div>
                </a>

                <!-- Navigation links in sidebar-->
                <a href="../../../../logout.php" class="sidebar-menu">
                    <div class="row row-sidebar-menu-logout">
                        <div class="col-3">
                            <img src="../../../../Assets/Asset15.png" alt="" class="img-right-side" />
                        </div>
                        <div class="col">Logout</div>
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
                            <a href="employee.php" class="nav-item nav-text-dashboard">Employee</a>
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
                                    <img src="../../../../Assets/Asset17.png" class="img-right-side" />
                                </div>
                            </div>
                        </div>
                        <!-- third column of top navbar -->
                        <div class="col">
                            <!-- row of profile @top navbar -->
                            <div class="row d-flex align-items-center">
                                <!-- profile picture -->
                                <div class="col-2">
                                    <img src="../../../../Assets/company-logo.png" class="img-right-side" />
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
                    <a href="../../employee-list.php" style="text-decoration: none;">
                        <div class="back">
                            < Back </div>
                    </a>
                </div>

                <div class="row d-flex align-items-center">
                    <div class="col profile-employee-title">
                        Profile Karyawan
                    </div>
                </div>

                <nav class="nav flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page"
                        href="../employee-details.php?employee_id=<?php echo $employee_id ?>">Overview</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="../employee-details-absensi.php?employee_id=<?php echo $employee_id ?>">Absensi</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-perfoma.html">Perfoma</a>
                    <a class="flex-sm-fill text-sm-center nav-link"
                        href="employee-details-permohonan.html">Permohonan</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-dokumen.html">Dokumen</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-catatan.html">Catatan</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="employee-details-riwayat.html">Riwayat</a>
                </nav>

                <div class="row">
                    <div class="col">

                        <?php
                        $query_one = "SELECT elp.language_name_1, ab.ability_name as mendengar_1 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_1 = ab.ability_id WHERE elp.ability_1 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_one = $connect->query($query_one);

                        while ($rows_one = $result_one->fetch_assoc()) {
                            $language_one = $rows_one['language_name_1'];
                            $hearing_one = $rows_one['mendengar_1'];
                        }

                        $query_two = "SELECT ab.ability_name as berbicara_1 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_2 = ab.ability_id WHERE elp.ability_2 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_two = $connect->query($query_two);

                        while ($rows_two = $result_two->fetch_assoc()) {
                            $speak_one = $rows_two['berbicara_1'];
                        }

                        $query_three = "SELECT ab.ability_name as membaca_1 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_3 = ab.ability_id WHERE elp.ability_3 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_three = $connect->query($query_three);

                        while ($rows_three = $result_three->fetch_assoc()) {
                            $read_one = $rows_three['membaca_1'];
                        }

                        $query_four = "SELECT ab.ability_name as menulis_1 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_4 = ab.ability_id WHERE elp.ability_4 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_four = $connect->query($query_four);

                        while ($rows_four = $result_four->fetch_assoc()) {
                            $write_one = $rows_four['menulis_1'];
                        }

                        $query_five = "SELECT elp.language_name_2, ab.ability_name as mendengar_2 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_5 = ab.ability_id WHERE elp.ability_5 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_five = $connect->query($query_five);

                        while ($rows_five = $result_five->fetch_assoc()) {
                            $language_two = $rows_five['language_name_2'];
                            $hearing_two = $rows_five['mendengar_2'];
                        }

                        $query_six = "SELECT ab.ability_name as berbicara_2 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_6 = ab.ability_id WHERE elp.ability_6 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_six = $connect->query($query_six);

                        while ($rows_six = $result_six->fetch_assoc()) {
                            $speak_two = $rows_six['berbicara_2'];
                        }

                        $query_seven = "SELECT ab.ability_name as membaca_2 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_7 = ab.ability_id WHERE elp.ability_7 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_seven = $connect->query($query_seven);

                        while ($rows_seven = $result_seven->fetch_assoc()) {
                            $read_two = $rows_seven['membaca_2'];
                        }

                        $query_eight = "SELECT ab.ability_name as menulis_2 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_8 = ab.ability_id WHERE elp.ability_8 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_eight = $connect->query($query_eight);

                        while ($rows_eight = $result_eight->fetch_assoc()) {
                            $write_two = $rows_eight['menulis_2'];
                        }

                        $query_nine = "SELECT elp.language_name_3, ab.ability_name as mendengar_3 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_9 = ab.ability_id WHERE elp.ability_9 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_nine = $connect->query($query_nine);

                        while ($rows_nine = $result_nine->fetch_assoc()) {
                            $language_three = $rows_nine['language_name_3'];
                            $hearing_three = $rows_nine['mendengar_3'];
                        }

                        $query_ten = "SELECT ab.ability_name as berbicara_3 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_10 = ab.ability_id WHERE elp.ability_10 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_ten = $connect->query($query_ten);

                        while ($rows_ten = $result_ten->fetch_assoc()) {
                            $speak_three = $rows_ten['berbicara_3'];
                        }

                        $query_eleven = "SELECT ab.ability_name as membaca_3 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_11 = ab.ability_id WHERE elp.ability_11 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_eleven = $connect->query($query_eleven);

                        while ($rows_eleven = $result_eleven->fetch_assoc()) {
                            $read_three = $rows_eleven['membaca_3'];
                        }

                        $query_twelve = "SELECT ab.ability_name as menulis_3 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_12 = ab.ability_id WHERE elp.ability_12 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_twelve = $connect->query($query_twelve);

                        while ($rows_twelve = $result_twelve->fetch_assoc()) {
                            $write_three = $rows_twelve['menulis_3'];
                        }

                        $query_thirteen = "SELECT elp.language_name_4, ab.ability_name as mendengar_4 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_13 = ab.ability_id WHERE elp.ability_13 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_thirteen = $connect->query($query_thirteen);

                        while ($rows_thirteen = $result_thirteen->fetch_assoc()) {
                            $language_four = $rows_thirteen['language_name_4'];
                            $hearing_four = $rows_thirteen['mendengar_4'];
                        }

                        $query_fourteen = "SELECT ab.ability_name as berbicara_4 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_14 = ab.ability_id WHERE elp.ability_14 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_fourteen = $connect->query($query_fourteen);

                        while ($rows_fourteen = $result_fourteen->fetch_assoc()) {
                            $speak_four = $rows_fourteen['berbicara_4'];
                        }

                        $query_fifteen = "SELECT ab.ability_name as membaca_4 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_15 = ab.ability_id WHERE elp.ability_15 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_fifteen = $connect->query($query_fifteen);

                        while ($rows_fifteen = $result_fifteen->fetch_assoc()) {
                            $read_four = $rows_fifteen['membaca_4'];
                        }

                        $query_sixteen = "SELECT ab.ability_name as menulis_4 FROM employee_language_professional elp JOIN ability_db ab ON elp.ability_16 = ab.ability_id WHERE elp.ability_16 = ab.ability_id AND elp.id = '$employee_id';";
                        $result_sixteen = $connect->query($query_sixteen);

                        while ($rows_sixteen = $result_sixteen->fetch_assoc()) {
                            $write_four = $rows_sixteen['menulis_4'];
                        }

                        ?>

                        <div class="card card-employee-1 mt-3">

                            <div class="basic-information">
                                Kemampuan Bahasa
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col-3">
                                    <div class="label-basic-5">Bahasa</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($language_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $language_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Mendengar</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($hearing_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $hearing_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Berbicara</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($speak_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $speak_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Membaca</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($read_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $read_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Menulis</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($write_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $write_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <div class="label-basic-5">Bahasa</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($language_two == NULL) {
                                            echo "-";
                                        } else {
                                            echo $language_two;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Mendengar</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($hearing_two == NULL) {
                                            echo "-";
                                        } else {
                                            echo $hearing_two;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Berbicara</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($speak_two == NULL) {
                                            echo "-";
                                        } else {
                                            echo $speak_two;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Membaca</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($read_two == NULL) {
                                            echo "-";
                                        } else {
                                            echo $read_two;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Menulis</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($write_two == NULL) {
                                            echo "-";
                                        } else {
                                            echo $write_two;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <div class="label-basic-5">Bahasa</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($language_three == NULL) {
                                            echo "-";
                                        } else {
                                            echo $language_three;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Mendengar</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($hearing_three == NULL) {
                                            echo "-";
                                        } else {
                                            echo $hearing_three;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Berbicara</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($speak_three == NULL) {
                                            echo "-";
                                        } else {
                                            echo $speak_three;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Membaca</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($read_three == NULL) {
                                            echo "-";
                                        } else {
                                            echo $read_three;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Menulis</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($write_three == NULL) {
                                            echo "-";
                                        } else {
                                            echo $write_three;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <div class="label-basic-5">Bahasa</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($language_four == NULL) {
                                            echo "-";
                                        } else {
                                            echo $language_four;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Mendengar</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($hearing_four == NULL) {
                                            echo "-";
                                        } else {
                                            echo $hearing_four;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Berbicara</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($speak_four == NULL) {
                                            echo "-";
                                        } else {
                                            echo $speak_four;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Membaca</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($read_four == NULL) {
                                            echo "-";
                                        } else {
                                            echo $read_four;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="label-basic-5">Menulis</div>
                                    <div class="value-basic-5">
                                        <?php
                                        if ($write_four == NULL) {
                                            echo "-";
                                        } else {
                                            echo $write_four;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>








                    </div>
                    <div class="col-3">
                        <div class="card card-employee-1 pt-3 mt-3 pb-3">

                            <a href="read-only-personal.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-left: 5%;">
                                <div class="employee-name">
                                    Informasi pribadi
                                </div>
                            </a>

                            <a href="read-only-address.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Data alamat
                                </div>
                            </a>

                            <a href="read-only-emploment.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Riwayat bekerja
                                </div>
                            </a>

                            <a href="read-only-education.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pendidikan
                                </div>
                            </a>

                            <a href="read-only-language.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name active">
                                    Kemampuan bahasa
                                </div>
                            </a>

                            <a href="" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Data keluarga
                                </div>
                            </a>

                            <a href="" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pertanyaan
                                </div>
                            </a>

                            <a href="" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pernyataan
                                </div>
                            </a>

                        </div>
                    </div>
                </div>



            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
        <script>
            function resetPass() {
                //alert('hi');

                response = confirm("Apakah anda yakin ingin melakukan reset password ?");
                if (response) {
                    // add code if the user pressed the Ok button
                    window.location.href = "reset-pass-backend.php?employee_id=<?php echo $employee_id ?>";
                } else {
                    // add code if the user pressed the Cancel button
                    alert("Reset password dibatalkan");
                }
            }

            function deleteAcc() {
                // alert('delete');

                deleteresponse = confirm("Apakah anda yakin ingin menghapus akun ini ?");

                if (deleteresponse) {
                    window.location.href = "delete-acc-backend.php?employee_id=<?php echo $employee_id ?>";
                } else {
                    alert('Hapus akun dibatalkan');
                }
            }   
        </script>
</body>

</html>