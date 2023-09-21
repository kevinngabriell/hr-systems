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

                        <?php

                        $education_one_query = "SELECT edb.education_name, eeh.emp_name_1, eeh.emp_major_1, eeh.emp_grade_1, eeh.emp_start_1, eeh.emp_end_1, eeh.emp_desc_1 FROM employee_education_history eeh JOIN education_db edb ON eeh.emp_edu_id_1 = edb.education_id WHERE eeh.emp_edu_id_1 = edb.education_id AND eeh.id = '$employee_id';";
                        $education_one_result = $connect->query($education_one_query);

                        while ($education_one_rows = $education_one_result->fetch_assoc()) {
                            $edu_type_one = $education_one_rows['education_name'];
                            $edu_name_one = $education_one_rows['emp_name_1'];
                            $edu_major_one = $education_one_rows['emp_major_1'];
                            $edu_grade_one = $education_one_rows['emp_grade_1'];
                            $edu_start_one = $education_one_rows['emp_start_1'];
                            $edu_end_one = $education_one_rows['emp_end_1'];
                            $edu_desc_one = $education_one_rows['emp_desc_1'];
                        }

                        ?>

                        <!-- education data 1  -->
                        <div class="card card-employee-1 mt-3">
                            <div class="basic-information">
                                Pendidikan #1
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Tingkat pendidikan</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($edu_type_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $edu_type_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Nama sekolah</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($edu_name_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $edu_name_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Jurusan</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($edu_major_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $edu_major_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="label-basic-information">Nilai</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($edu_grade_one == NULL) {
                                            echo "-";
                                        } else {
                                            echo $edu_grade_one;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Tahun masuk</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($edu_start_one == NULL) {
                                            echo "-";
                                        } else {
                                            $newStartDate1 = date("d M Y", strtotime($edu_start_one));
                                            echo $newStartDate1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-basic-information">Tahun selesai</div>
                                    <div class="value-basic">
                                        <?php
                                        if ($edu_end_one == NULL) {
                                            echo "-";
                                        } else {
                                            $newEndDate1 = date("d M Y", strtotime($edu_end_one));
                                            echo $newEndDate1;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="label-basic-4">Deskripsi pendidikan</div>
                                <div class="value-basic-4">
                                    <?php
                                    if ($edu_desc_one == NULL) {
                                        echo "-";
                                    } else {
                                        echo $edu_desc_one;
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>

                        <?php
                        $education_two_query = "SELECT edb.education_name, eeh.emp_name_2, eeh.emp_major_2, eeh.emp_grade_2, eeh.emp_start_2, eeh.emp_end_2, eeh.emp_desc_2 FROM employee_education_history eeh JOIN education_db edb ON eeh.emp_edu_id_2 = edb.education_id WHERE eeh.emp_edu_id_2 = edb.education_id AND eeh.id = '$employee_id';";
                        $education_two_result = $connect->query($education_two_query);

                        while ($education_two_rows = $education_two_result->fetch_assoc()) {
                            $edu_type_two = $education_two_rows['education_name'];
                            $edu_name_two = $education_two_rows['emp_name_2'];
                            $edu_major_two = $education_two_rows['emp_major_2'];
                            $edu_grade_two = $education_two_rows['emp_grade_2'];
                            $edu_start_two = $education_two_rows['emp_start_2'];
                            $edu_end_two = $education_two_rows['emp_end_2'];
                            $edu_desc_two = $education_two_rows['emp_desc_2'];
                        }
                        ?>

                        <?php
                        if ($edu_type_two != NULL) {
                            ?>

                            <!-- education data 2  -->
                            <div class="card card-employee-1 mt-4">
                                <div class="basic-information">
                                    Pendidikan #2
                                </div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Tingkat pendidikan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_type_two == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_type_two;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Nama sekolah</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_name_two == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_name_two;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Jurusan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_major_two == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_major_two;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Nilai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_grade_two == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_grade_two;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Tahun masuk</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_start_two == NULL) {
                                                echo "-";
                                            } else {
                                                $newStartDate1 = date("d M Y", strtotime($edu_start_two));
                                                echo $newStartDate1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Tahun selesai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_end_two == NULL) {
                                                echo "-";
                                            } else {
                                                $newEndDate1 = date("d M Y", strtotime($edu_end_two));
                                                echo $newEndDate1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="label-basic-4">Deskripsi pendidikan</div>
                                    <div class="value-basic-4">
                                        <?php
                                        if ($edu_desc_two == NULL) {
                                            echo "-";
                                        } else {
                                            echo $edu_desc_two;
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                            <?php
                        }
                        ?>

                        <?php
                        $education_three_query = "SELECT edb.education_name, eeh.emp_name_3, eeh.emp_major_3, eeh.emp_grade_3, eeh.emp_start_3, eeh.emp_end_3, eeh.emp_desc_3 FROM employee_education_history eeh JOIN education_db edb ON eeh.emp_edu_id_3 = edb.education_id WHERE eeh.emp_edu_id_3 = edb.education_id AND eeh.id = '$employee_id';";
                        $education_three_result = $connect->query($education_three_query);

                        while ($education_three_rows = $education_three_result->fetch_assoc()) {
                            $edu_type_three = $education_three_rows['education_name'];
                            $edu_name_three = $education_three_rows['emp_name_3'];
                            $edu_major_three = $education_three_rows['emp_major_3'];
                            $edu_grade_three = $education_three_rows['emp_grade_3'];
                            $edu_start_three = $education_three_rows['emp_start_3'];
                            $edu_end_three = $education_three_rows['emp_end_3'];
                            $edu_desc_three = $education_three_rows['emp_desc_3'];
                        }
                        ?>

                        <?php
                        if ($edu_type_three != NULL) {
                            ?>

                            <!-- education data 3  -->
                            <div class="card card-employee-1 mt-4">
                                <div class="basic-information">
                                    Pendidikan #3
                                </div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Tingkat pendidikan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_type_three == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_type_three;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Nama sekolah</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_name_three == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_name_three;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Jurusan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_major_three == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_major_three;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Nilai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_grade_three == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_grade_three;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Tahun masuk</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_start_three == NULL) {
                                                echo "-";
                                            } else {
                                                $newStartDate1 = date("d M Y", strtotime($edu_start_three));
                                                echo $newStartDate1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Tahun selesai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_end_three == NULL) {
                                                echo "-";
                                            } else {
                                                $newEndDate1 = date("d M Y", strtotime($edu_end_three));
                                                echo $newEndDate1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="label-basic-4">Deskripsi pendidikan</div>
                                    <div class="value-basic-4">
                                        <?php
                                        if ($edu_desc_three == NULL) {
                                            echo "-";
                                        } else {
                                            echo $edu_desc_three;
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                            <?php
                        }
                        ?>

                        <?php
                        $education_four_query = "SELECT edb.education_name, eeh.emp_name_4, eeh.emp_major_4, eeh.emp_grade_4, eeh.emp_start_4, eeh.emp_end_4, eeh.emp_desc_4 FROM employee_education_history eeh JOIN education_db edb ON eeh.emp_edu_id_4 = edb.education_id WHERE eeh.emp_edu_id_4 = edb.education_id AND eeh.id = '$employee_id';";
                        $education_four_result = $connect->query($education_four_query);

                        while ($education_four_rows = $education_four_result->fetch_assoc()) {
                            $edu_type_four = $education_four_rows['education_name'];
                            $edu_name_four = $education_four_rows['emp_name_4'];
                            $edu_major_four = $education_four_rows['emp_major_4'];
                            $edu_grade_four = $education_four_rows['emp_grade_4'];
                            $edu_start_four = $education_four_rows['emp_start_4'];
                            $edu_end_four = $education_four_rows['emp_end_4'];
                            $edu_desc_four = $education_four_rows['emp_desc_4'];
                        }
                        ?>

                        <?php
                        if ($edu_type_four != NULL) {
                            ?>

                            <!-- education data 4  -->
                            <div class="card card-employee-1 mt-4">
                                <div class="basic-information">
                                    Pendidikan #4
                                </div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Tingkat pendidikan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_type_four == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_type_four;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Nama sekolah</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_name_four == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_name_four;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Jurusan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_major_four == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_major_four;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Nilai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_grade_four == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_grade_four;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Tahun masuk</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_start_four == NULL) {
                                                echo "-";
                                            } else {
                                                $newStartDate1 = date("d M Y", strtotime($edu_start_four));
                                                echo $newStartDate1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Tahun selesai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_end_four == NULL) {
                                                echo "-";
                                            } else {
                                                $newEndDate1 = date("d M Y", strtotime($edu_end_four));
                                                echo $newEndDate1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="label-basic-4">Deskripsi pendidikan</div>
                                    <div class="value-basic-4">
                                        <?php
                                        if ($edu_desc_four == NULL) {
                                            echo "-";
                                        } else {
                                            echo $edu_desc_four;
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                            <?php
                        } else {
                            ?>
                            <div class="space mt-5">
                                <p> </p>
                            </div>
                            <?php
                        }
                        ?>


                        <?php
                        $education_five_query = "SELECT edb.education_name, eeh.emp_name_5, eeh.emp_major_5, eeh.emp_grade_5, eeh.emp_start_5, eeh.emp_end_5, eeh.emp_desc_5 FROM employee_education_history eeh JOIN education_db edb ON eeh.emp_edu_id_5 = edb.education_id WHERE eeh.emp_edu_id_5 = edb.education_id AND eeh.id = '$employee_id';";
                        $education_five_result = $connect->query($education_five_query);

                        while ($education_five_rows = $education_five_result->fetch_assoc()) {
                            $edu_type_five = $education_five_rows['education_name'];
                            $edu_name_five = $education_five_rows['emp_name_5'];
                            $edu_major_five = $education_five_rows['emp_major_5'];
                            $edu_grade_five = $education_five_rows['emp_grade_5'];
                            $edu_start_five = $education_five_rows['emp_start_5'];
                            $edu_end_five = $education_five_rows['emp_end_5'];
                            $edu_desc_five = $education_five_rows['emp_desc_5'];
                        }
                        ?>

                        <?php
                            if($edu_type_five != NULL){
                        ?>
                         <!-- education data 5  -->
                         <div class="card card-employee-1 mt-4">
                                <div class="basic-information">
                                    Pendidikan #5
                                </div>

                                <div class="row mt-3 mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Tingkat pendidikan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_type_five == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_type_five;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Nama sekolah</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_name_five == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_name_five;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Jurusan</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_major_five == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_major_five;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="label-basic-information">Nilai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_grade_five == NULL) {
                                                echo "-";
                                            } else {
                                                echo $edu_grade_five;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Tahun masuk</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_start_five == NULL) {
                                                echo "-";
                                            } else {
                                                $newStartDate1 = date("d M Y", strtotime($edu_start_five));
                                                echo $newStartDate1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="label-basic-information">Tahun selesai</div>
                                        <div class="value-basic">
                                            <?php
                                            if ($edu_end_five == NULL) {
                                                echo "-";
                                            } else {
                                                $newEndDate1 = date("d M Y", strtotime($edu_end_five));
                                                echo $newEndDate1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="label-basic-4">Deskripsi pendidikan</div>
                                    <div class="value-basic-4">
                                        <?php
                                        if ($edu_desc_five == NULL) {
                                            echo "-";
                                        } else {
                                            echo $edu_desc_five;
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        <?php
                            } else {
                        ?>
                        <div class="space mt-5">
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
                                <div class="employee-name active">
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