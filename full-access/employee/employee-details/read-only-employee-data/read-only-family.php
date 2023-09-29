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
                    <a href="../employee-details.php?employee_id=<?php echo $employee_id ?>" style="text-decoration: none;">
                        <div class="back">
                            < Back </div>
                    </a>
                </div>

                <div class="row d-flex align-items-center">
                    <div class="col profile-employee-title">
                        Profile Karyawan
                    </div>
                </div>

                <!-- <nav class="nav flex-column flex-sm-row">
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
                </nav> -->

                <div class="row">
                    <div class="col">

                        <!-- family data 1 -->
                        <?php
                        $family_query_one = "SELECT fd.family_name as type_1 , efb.family_name_1, efb.family_address_1, efb.family_pob_1, efb.family_dob_1, ed.education_name as education_1 , efb.family_job_1 FROM employee_family_background efb JOIN family_db fd ON efb.family_type_1 = fd.id_family JOIN education_db ed ON efb.family_last_edu_1 = ed.education_id WHERE efb.family_type_1 = fd.id_family AND efb.family_last_edu_1 = ed.education_id AND efb.id = '$employee_id';";
                        $family_result_one = $connect->query($family_query_one);

                        while ($family_rows_one = $family_result_one->fetch_array()) {
                            $type_1 = $family_rows_one['type_1'];
                            $name_1 = $family_rows_one['family_name_1'];
                            $address_1 = $family_rows_one['family_address_1'];
                            $pob_1 = $family_rows_one['family_pob_1'];
                            $dob_1 = $family_rows_one['family_dob_1'];
                            $education_1 = $family_rows_one['education_1'];
                            $job_1 = $family_rows_one['family_job_1'];
                        }
                        ?>

                        <div class="card card-employee-1 mt-3">

                            <div class="basic-information">Data keluarga #1</div>

                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <div class="label-basic-3">
                                        Hubungan keluarga
                                    </div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($type_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $type_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-3">
                                        Nama lengkap
                                    </div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($name_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $name_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-3">
                                        Tempat, tanggal lahir
                                    </div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($pob_1 == NULL || $dob_1 == NULL) {
                                            echo "-";
                                        } else {
                                            $dob1 = date("d M Y", strtotime($dob_1));
                                            $today = date("y-m-d");
                                            $diff = abs(strtotime($today) - strtotime($dob_1));
                                            $years = floor($diff / (365 * 60 * 60 * 24));

                                            echo "$pob_1, $dob1 ($years tahun)";
                                        }

                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-3">
                                        Alamat
                                    </div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($address_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $address_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-3">
                                        Pendidikan terakhir
                                    </div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($education_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $education_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-3">
                                        Pekerjaan
                                    </div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($job_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $job_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- family data 2 -->
                        <?php
                        $family_query_two = "SELECT fd.family_name as type_2 , efb.family_name_2, efb.family_address_2, efb.family_pob_2, efb.family_dob_2, ed.education_name as education_2 , efb.family_job_2 FROM employee_family_background efb JOIN family_db fd ON efb.family_type_2 = fd.id_family JOIN education_db ed ON efb.family_last_edu_2 = ed.education_id WHERE efb.family_type_2 = fd.id_family AND efb.family_last_edu_2 = ed.education_id AND efb.id = '$employee_id';";
                        $family_result_two = $connect->query($family_query_two);

                        while ($family_rows_two = $family_result_two->fetch_array()) {
                            $type_2 = $family_rows_two['type_2'];
                            $name_2 = $family_rows_two['family_name_2'];
                            $address_2 = $family_rows_two['family_address_2'];
                            $pob_2 = $family_rows_two['family_pob_2'];
                            $dob_2 = $family_rows_two['family_dob_2'];
                            $education_2 = $family_rows_two['education_2'];
                            $job_2 = $family_rows_two['family_job_2'];
                        }

                        if ($type_2 != NULL) {
                            ?>

                            <div class="card card-employee-1 mt-4">

                                <div class="basic-information">Data keluarga #2</div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Hubungan keluarga
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($type_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $type_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Nama lengkap
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($name_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $name_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Tempat, tanggal lahir
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($pob_2 == NULL || $dob_2 == NULL) {
                                                echo "-";
                                            } else {
                                                $dob2 = date("d M Y", strtotime($dob_2));
                                                $today = date("y-m-d");
                                                $diff = abs(strtotime($today) - strtotime($dob_2));
                                                $years = floor($diff / (365 * 60 * 60 * 24));

                                                echo "$pob_2, $dob2 ($years tahun)";
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Alamat
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($address_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $address_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Pendidikan terakhir
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($education_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $education_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Pekerjaan
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($job_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $job_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php
                        } else {

                        }
                        ?>

                        <!-- family data 3-->
                        <?php
                        $family_query_three = "SELECT fd.family_name as type_3 , efb.family_name_3, efb.family_address_3, efb.family_pob_3, efb.family_dob_3, ed.education_name as education_3 , efb.family_job_3 FROM employee_family_background efb JOIN family_db fd ON efb.family_type_3 = fd.id_family JOIN education_db ed ON efb.family_last_edu_3 = ed.education_id WHERE efb.family_type_3 = fd.id_family OR efb.family_last_edu_3 = ed.education_id AND efb.id = '$employee_id';";
                        $family_result_three = $connect->query($family_query_three);

                        while ($family_rows_three = $family_result_three->fetch_array()) {
                            $type_3 = $family_rows_three['type_3'];
                            $name_3 = $family_rows_three['family_name_3'];
                            $address_3 = $family_rows_three['family_address_3'];
                            $pob_3 = $family_rows_three['family_pob_3'];
                            $dob_3 = $family_rows_three['family_dob_3'];
                            $education_3 = $family_rows_three['education_3'];
                            $job_3 = $family_rows_three['family_job_3'];
                        }

                        if ($type_3 != NULL) {
                            ?>

                            <div class="card card-employee-1 mt-4">

                                <div class="basic-information">Data keluarga #3</div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Hubungan keluarga
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($type_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $type_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Nama lengkap
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($name_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $name_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Tempat, tanggal lahir
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($pob_3 == NULL || $dob_3 == NULL) {
                                                echo "-";
                                            } else {
                                                $dob3 = date("d M Y", strtotime($dob_3));
                                                $today = date("y-m-d");
                                                $diff = abs(strtotime($today) - strtotime($dob_3));
                                                $years = floor($diff / (365 * 60 * 60 * 24));

                                                echo "$pob_3, $dob3 ($years tahun)";
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Alamat
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($address_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $address_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Pendidikan terakhir
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($education_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $education_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Pekerjaan
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($job_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $job_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php
                        } else {

                        }
                        ?>

                        <!-- family data 4-->
                        <?php
                        $family_query_four = "SELECT fd.family_name as type_4 , efb.family_name_4, efb.family_address_4, efb.family_pob_4, efb.family_dob_4, ed.education_name as education_4 , efb.family_job_4 FROM employee_family_background efb JOIN family_db fd ON efb.family_type_4 = fd.id_family JOIN education_db ed ON efb.family_last_edu_4 = ed.education_id WHERE efb.family_type_4 = fd.id_family OR efb.family_last_edu_4 = ed.education_id AND efb.id = '$employee_id';";
                        $family_result_four = $connect->query($family_query_four);

                        while ($family_rows_four = $family_result_four->fetch_array()) {
                            $type_4 = $family_rows_four['type_4'];
                            $name_4 = $family_rows_four['family_name_4'];
                            $address_4 = $family_rows_four['family_address_4'];
                            $pob_4 = $family_rows_four['family_pob_4'];
                            $dob_4 = $family_rows_four['family_dob_4'];
                            $education_4 = $family_rows_four['education_4'];
                            $job_4 = $family_rows_four['family_job_4'];
                        }

                        if ($type_4 != NULL) {
                            ?>

                            <div class="card card-employee-1 mt-4">

                                <div class="basic-information">Data keluarga #4</div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Hubungan keluarga
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($type_4 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $type_4;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Nama lengkap
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($name_4 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $name_4;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Tempat, tanggal lahir
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($pob_4 == NULL || $dob_4 == NULL) {
                                                echo "-";
                                            } else {
                                                $dob4 = date("d M Y", strtotime($dob_4));
                                                $today = date("y-m-d");
                                                $diff = abs(strtotime($today) - strtotime($dob_4));
                                                $years = floor($diff / (365 * 60 * 60 * 24));

                                                echo "$pob_4, $dob4 ($years tahun)";
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Alamat
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($address_4 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $address_4;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Pendidikan terakhir
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($education_4 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $education_4;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Pekerjaan
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($job_4 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $job_4;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php
                        } else {
                            ?>
                            <div class="spacer mt-5">
                                <p> </p>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- family data 5-->
                        <?php
                        $family_query_five = "SELECT fd.family_name as type_5 , efb.family_name_5, efb.family_address_5, efb.family_pob_5, efb.family_dob_5, ed.education_name as education_5 , efb.family_job_5 FROM employee_family_background efb JOIN family_db fd ON efb.family_type_5 = fd.id_family JOIN education_db ed ON efb.family_last_edu_5 = ed.education_id WHERE efb.family_type_5 = fd.id_family OR efb.family_last_edu_5 = ed.education_id AND efb.id = '$employee_id';";
                        $family_result_five = $connect->query($family_query_five);

                        while ($family_rows_five = $family_result_five->fetch_array()) {
                            $type_5 = $family_rows_five['type_5'];
                            $name_5 = $family_rows_five['family_name_5'];
                            $address_5 = $family_rows_five['family_address_5'];
                            $pob_5 = $family_rows_five['family_pob_5'];
                            $dob_5 = $family_rows_five['family_dob_5'];
                            $education_5 = $family_rows_five['education_5'];
                            $job_5 = $family_rows_five['family_job_5'];
                        }

                        if ($type_5 != NULL) {
                            ?>

                            <div class="card card-employee-1 mt-4 mb-5">

                                <div class="basic-information">Data keluarga #5</div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Hubungan keluarga
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($type_5 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $type_5;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Nama lengkap
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($name_5 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $name_5;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Tempat, tanggal lahir
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($pob_5 == NULL || $dob_5 == NULL) {
                                                echo "-";
                                            } else {
                                                $dob5 = date("d M Y", strtotime($dob_5));
                                                $today = date("y-m-d");
                                                $diff = abs(strtotime($today) - strtotime($dob_5));
                                                $years = floor($diff / (365 * 60 * 60 * 24));

                                                echo "$pob_5, $dob5 ($years tahun)";
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Alamat
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($address_5 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $address_5;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Pendidikan terakhir
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($education_5 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $education_5;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">
                                            Pekerjaan
                                        </div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($job_5 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $job_5;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php
                        } else {
                            ?>
                            <div class="spacer mt-5">
                                <p> </p>
                            </div>
                        <?php
                        }
                        ?>





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
                                <div class="employee-name">
                                    Kemampuan bahasa
                                </div>
                            </a>

                            <a href="read-only-family.php?employee_id=<?= $employee_id ?>"
                                style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name active">
                                    Data keluarga
                                </div>
                            </a>

                            <a href="read-only-question.php?employee_id=<?= $employee_id ?>" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pertanyaan
                                </div>
                            </a>

                            <!-- <a href="" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pernyataan
                                </div>
                            </a> -->

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