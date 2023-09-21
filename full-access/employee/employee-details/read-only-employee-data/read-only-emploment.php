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

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
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

                        <div class="card card-employee-1 mt-3">

                            <div class="basic-information">
                                Riwayat bekerja #1
                            </div>

                            <?php
                            $employement_history_query = "SELECT * FROM employee_employement_history WHERE id = '$employee_id'";
                            $employement_history_result = $connect->query($employement_history_query);

                            while ($employement_history_rows = $employement_history_result->fetch_assoc()) {
                                $company_name_1 = $employement_history_rows['company_name_1'];
                                $company_name_2 = $employement_history_rows['company_name_2'];
                                $company_name_3 = $employement_history_rows['company_name_3'];
                                $company_position_1 = $employement_history_rows['company_position_1'];
                                $company_position_2 = $employement_history_rows['company_position_2'];
                                $company_position_3 = $employement_history_rows['company_position_3'];
                                $company_address_1 = $employement_history_rows['company_address_1'];
                                $company_address_2 = $employement_history_rows['company_address_2'];
                                $company_address_3 = $employement_history_rows['company_address_3'];
                                $company_type_1 = $employement_history_rows['company_type_1'];
                                $company_type_2 = $employement_history_rows['company_type_2'];
                                $company_type_3 = $employement_history_rows['company_type_3'];
                                $company_start_1 = $employement_history_rows['company_start_1'];
                                $company_start_2 = $employement_history_rows['company_start_2'];
                                $company_start_3 = $employement_history_rows['company_start_3'];
                                $company_end_1 = $employement_history_rows['company_end_1'];
                                $company_end_2 = $employement_history_rows['company_end_2'];
                                $company_end_3 = $employement_history_rows['company_end_3'];
                                $company_leader_1 = $employement_history_rows['company_leader_1'];
                                $company_leader_2 = $employement_history_rows['company_leader_2'];
                                $company_leader_3 = $employement_history_rows['company_leader_3'];
                                $company_salary_1 = $employement_history_rows['company_salary_1'];
                                $company_salary_2 = $employement_history_rows['company_salary_2'];
                                $company_salary_3 = $employement_history_rows['company_salary_3'];
                                $company_jobdesc_1 = $employement_history_rows['company_jobdesc_1'];
                                $company_jobdesc_2 = $employement_history_rows['company_jobdesc_2'];
                                $company_jobdesc_3 = $employement_history_rows['company_jobdesc_3'];
                                $company_leave_1 = $employement_history_rows['company_leave_1'];
                                $company_leave_2 = $employement_history_rows['company_leave_2'];
                                $company_leave_3 = $employement_history_rows['company_leave_3'];
                            }
                            ?>

                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Nama perusahaan</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_name_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $company_name_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Jenis usaha</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_type_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $company_type_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Posisi terakhir</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_position_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $company_position_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Mulai</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_start_1 == NULL) {
                                            echo "-";
                                        } else {
                                            $newStartDate1 = date("d M Y", strtotime($company_start_1));
                                            echo $newStartDate1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Akhir</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_end_1 == NULL) {
                                            echo "-";
                                        } else {
                                            $newEndDate1 = date("d M Y", strtotime($company_end_1));
                                            echo $newEndDate1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Total periode</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_end_1 == NULL) {
                                            $today = date("y-m-d");
                                            $diff = abs(strtotime($today) - strtotime($company_start_1));
                                            $years = floor($diff / (365 * 60 * 60 * 24));
                                            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                            echo $years . " tahun " . $months . " bulan " . $days . " hari";
                                        } else {
                                            $diff = abs(strtotime($company_end_1) - strtotime($company_start_1));
                                            $years = floor($diff / (365 * 60 * 60 * 24));
                                            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                            echo $years . " tahun " . $months . " bulan " . $days . " hari";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Alasan keluar</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_leave_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $company_leave_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Atasan</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_leader_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $company_leader_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Gaji</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($company_salary_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo rupiah($company_salary_1);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-3">Alamat perusahaan</div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($company_address_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $company_address_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-3">Deskripsi perusahaan</div>
                                    <div class="value-basic-3">
                                        <?php
                                        if ($company_jobdesc_1 == NULL) {
                                            echo "-";
                                        } else {
                                            echo $company_jobdesc_1;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <?php
                        if ($company_name_2 != NULL) {
                            ?>
                            <div class="card card-employee-1 mt-4">

                                <div class="basic-information">
                                    Riwayat bekerja #2
                                </div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Nama perusahaan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_name_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_name_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Jenis usaha</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_type_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_type_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Posisi terakhir</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_position_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_position_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Mulai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_start_2 == NULL) {
                                                echo "-";
                                            } else {
                                                $newStartDate2 = date("d M Y", strtotime($company_start_2));
                                                echo $newStartDate2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Akhir</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_end_2 == NULL) {
                                                echo "-";
                                            } else {
                                                $newEndDate2 = date("d M Y", strtotime($company_end_2));
                                                echo $newEndDate2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Total periode</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_end_2 == NULL) {
                                                $today = date("y-m-d");
                                                $diff = abs(strtotime($today) - strtotime($company_start_2));
                                                $years = floor($diff / (365 * 60 * 60 * 24));
                                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                                echo $years . " tahun " . $months . " bulan " . $days . " hari";
                                            } else {
                                                $diff = abs(strtotime($company_end_2) - strtotime($company_start_2));
                                                $years = floor($diff / (365 * 60 * 60 * 24));
                                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                                echo $years . " tahun " . $months . " bulan " . $days . " hari";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Alasan keluar</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_leave_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_leave_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Atasan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_leader_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_leader_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Gaji</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_salary_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo rupiah($company_salary_2);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">Alamat perusahaan</div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($company_address_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_address_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">Deskripsi perusahaan</div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($company_jobdesc_2 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_jobdesc_2;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?
                        }
                        ?>

                        <?php
                        if ($company_name_3 != NULL) {
                            ?>
                            <div class="card card-employee-1 mt-4">

                                <div class="basic-information">
                                    Riwayat bekerja #3
                                </div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Nama perusahaan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_name_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_name_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Jenis usaha</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_type_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_type_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Posisi terakhir</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_position_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_position_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Mulai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_start_3 == NULL) {
                                                echo "-";
                                            } else {
                                                $newStartDate3 = date("d M Y", strtotime($company_start_3));
                                                echo $newStartDate3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Akhir</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_end_3 == NULL) {
                                                echo "-";
                                            } else {
                                                $newEndDate3 = date("d M Y", strtotime($company_end_3));
                                                echo $newEndDate3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Total periode</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_end_3 == NULL) {
                                                $today = date("y-m-d");
                                                $diff = abs(strtotime($today) - strtotime($company_start_3));
                                                $years = floor($diff / (365 * 60 * 60 * 24));
                                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                                echo $years . " tahun " . $months . " bulan " . $days . " hari";
                                            } else {
                                                $diff = abs(strtotime($company_end_3) - strtotime($company_start_3));
                                                $years = floor($diff / (365 * 60 * 60 * 24));
                                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                                echo $years . " tahun " . $months . " bulan " . $days . " hari";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Alasan keluar</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_leave_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_leave_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Atasan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_leader_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_leader_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Gaji</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($company_salary_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo rupiah($company_salary_3);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-3">Alamat perusahaan</div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($company_address_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_address_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-3">Deskripsi perusahaan</div>
                                        <div class="value-basic-3">
                                            <?php
                                            if ($company_jobdesc_3 == NULL) {
                                                echo "-";
                                            } else {
                                                echo $company_jobdesc_3;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?
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
                                <div class="employee-name active">
                                    Riwayat bekerja
                                </div>
                            </a>

                            <a href="read-only-education.php?employee_id=<?= $employee_id ?>" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
                                    Pendidikan
                                </div>
                            </a>

                            <a href="read-only-language.php?employee_id=<?= $employee_id ?>" style="text-decoration: none; margin-top: 3%; margin-left: 5%;">
                                <div class="employee-name">
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